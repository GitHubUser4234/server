<?php
/**
 * @author Joas Schilling <nickvergessen@owncloud.com>
 *
 * @copyright Copyright (c) 2015, ownCloud, Inc.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace Test\DB\QueryBuilder;

use Doctrine\DBAL\Query\Expression\CompositeExpression;
use OC\DB\QueryBuilder\Literal;
use OC\DB\QueryBuilder\Parameter;
use OC\DB\QueryBuilder\QueryBuilder;

class QueryBuilderTest extends \Test\TestCase {
	/** @var QueryBuilder */
	protected $queryBuilder;

	protected function setUp() {
		parent::setUp();

		$connection = \OC::$server->getDatabaseConnection();

		$this->queryBuilder = new QueryBuilder($connection);
	}

	public function dataFirstResult() {
		return [
			[null, [['configvalue' => 99], ['configvalue' => 98], ['configvalue' => 97], ['configvalue' => 96], ['configvalue' => 95], ['configvalue' => 94], ['configvalue' => 93], ['configvalue' => 92], ['configvalue' => 91]]],
			[0, [['configvalue' => 99], ['configvalue' => 98], ['configvalue' => 97], ['configvalue' => 96], ['configvalue' => 95], ['configvalue' => 94], ['configvalue' => 93], ['configvalue' => 92], ['configvalue' => 91]]],
			[1, [['configvalue' => 98], ['configvalue' => 97], ['configvalue' => 96], ['configvalue' => 95], ['configvalue' => 94], ['configvalue' => 93], ['configvalue' => 92], ['configvalue' => 91]]],
			[5, [['configvalue' => 94], ['configvalue' => 93], ['configvalue' => 92], ['configvalue' => 91]]],
		];
	}

	/**
	 * @dataProvider dataFirstResult
	 *
	 * @param int $firstResult
	 * @param array $expectedSet
	 */
	public function testFirstResult($firstResult, $expectedSet) {
		$eB = $this->queryBuilder->expr();

		for ($i = 1; $i < 10; $i++) {
			$this->queryBuilder->insert('*PREFIX*appconfig')
				->values([
					'appid' => $eB->literal('testFirstResult'),
					'configkey' => $eB->literal('testing' . $i),
					'configvalue' => $eB->literal(100 - $i),
				]);
			$this->queryBuilder->execute();
		}
		$this->queryBuilder->resetQueryParts();

		if ($firstResult !== null) {
			$this->queryBuilder->setFirstResult($firstResult);
		}

		$this->assertSame(
			$firstResult,
			$this->queryBuilder->getFirstResult()
		);

		$this->queryBuilder->select('configvalue')
			->from('*PREFIX*appconfig')
			->where($eB->eq('appid', $eB->literal('testFirstResult')))
			->orderBy('configkey', 'ASC');

		$query = $this->queryBuilder->execute();
		$this->assertSame(sizeof($expectedSet), $query->rowCount());
		$this->assertEquals($expectedSet, $query->fetchAll());

		$this->queryBuilder->delete('*PREFIX*appconfig')
			->where($eB->eq('appid', $eB->literal('testFirstResult')));

		$query = $this->queryBuilder->execute();
	}

	public function dataMaxResults() {
		return [
			[null, ''],
			[0, ' LIMIT 0'],
			[1, ' LIMIT 1'],
			[5, ' LIMIT 5'],
		];
	}

	/**
	 * @dataProvider dataMaxResults
	 *
	 * @param int $maxResult
	 * @param string $expectedLimit
	 */
	public function testMaxResults($maxResult, $expectedLimit) {
		if ($maxResult !== null) {
			$this->queryBuilder->setMaxResults($maxResult);
		}

		$this->assertSame(
			$maxResult,
			$this->queryBuilder->getMaxResults()
		);

		$this->assertSame(
			'SELECT  FROM ' . $expectedLimit,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataSelect() {
		return [
			// select('column1')
			[['column1'], ['`column1`'], '`column1`'],

			// select('column1', 'column2')
			[['column1', 'column2'], ['`column1`', '`column2`'], '`column1`, `column2`'],

			// select(['column1', 'column2'])
			[[['column1', 'column2']], ['`column1`', '`column2`'], '`column1`, `column2`'],

			// select(new Literal('column1'))
			[[new Literal('column1')], ['column1'], 'column1'],

			// select('column1', 'column2')
			[[new Literal('column1'), 'column2'], ['column1', '`column2`'], 'column1, `column2`'],

			// select(['column1', 'column2'])
			[[[new Literal('column1'), 'column2']], ['column1', '`column2`'], 'column1, `column2`'],
		];
	}

	/**
	 * @dataProvider dataSelect
	 *
	 * @param array $selectArguments
	 * @param array $expectedQueryPart
	 * @param string $expectedSelect
	 */
	public function testSelect($selectArguments, $expectedQueryPart, $expectedSelect) {
		call_user_func_array(
			[$this->queryBuilder, 'select'],
			$selectArguments
		);

		$this->assertSame(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('select')
		);

		$this->assertSame(
			'SELECT ' . $expectedSelect . ' FROM ',
			$this->queryBuilder->getSQL()
		);
	}

	public function dataAddSelect() {
		return [
			// addSelect('column1')
			[['column1'], ['`column`', '`column1`'], '`column`, `column1`'],

			// addSelect('column1', 'column2')
			[['column1', 'column2'], ['`column`', '`column1`', '`column2`'], '`column`, `column1`, `column2`'],

			// addSelect(['column1', 'column2'])
			[[['column1', 'column2']], ['`column`', '`column1`', '`column2`'], '`column`, `column1`, `column2`'],

			// select(new Literal('column1'))
			[[new Literal('column1')], ['`column`', 'column1'], '`column`, column1'],

			// select('column1', 'column2')
			[[new Literal('column1'), 'column2'], ['`column`', 'column1', '`column2`'], '`column`, column1, `column2`'],

			// select(['column1', 'column2'])
			[[[new Literal('column1'), 'column2']], ['`column`', 'column1', '`column2`'], '`column`, column1, `column2`'],
		];
	}

	/**
	 * @dataProvider dataAddSelect
	 *
	 * @param array $selectArguments
	 * @param array $expectedQueryPart
	 * @param string $expectedSelect
	 */
	public function testAddSelect($selectArguments, $expectedQueryPart, $expectedSelect) {
		$this->queryBuilder->select('column');
		call_user_func_array(
			[$this->queryBuilder, 'addSelect'],
			$selectArguments
		);

		$this->assertSame(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('select')
		);

		$this->assertSame(
			'SELECT ' . $expectedSelect . ' FROM ',
			$this->queryBuilder->getSQL()
		);
	}

	public function dataDelete() {
		return [
			['data', null, ['table' => '`data`', 'alias' => null], '`data`'],
			['data', 't', ['table' => '`data`', 'alias' => 't'], '`data` t'],
		];
	}

	/**
	 * @dataProvider dataDelete
	 *
	 * @param string $tableName
	 * @param string $tableAlias
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testDelete($tableName, $tableAlias, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->delete($tableName, $tableAlias);

		$this->assertSame(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('from')
		);

		$this->assertSame(
			'DELETE FROM ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataUpdate() {
		return [
			['data', null, ['table' => '`data`', 'alias' => null], '`data`'],
			['data', 't', ['table' => '`data`', 'alias' => 't'], '`data` t'],
		];
	}

	/**
	 * @dataProvider dataUpdate
	 *
	 * @param string $tableName
	 * @param string $tableAlias
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testUpdate($tableName, $tableAlias, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->update($tableName, $tableAlias);

		$this->assertSame(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('from')
		);

		$this->assertSame(
			'UPDATE ' . $expectedQuery . ' SET ',
			$this->queryBuilder->getSQL()
		);
	}

	public function dataInsert() {
		return [
			['data', ['table' => '`data`'], '`data`'],
		];
	}

	/**
	 * @dataProvider dataInsert
	 *
	 * @param string $tableName
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testInsert($tableName, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->insert($tableName);

		$this->assertSame(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('from')
		);

		$this->assertSame(
			'INSERT INTO ' . $expectedQuery . ' () VALUES()',
			$this->queryBuilder->getSQL()
		);
	}

	public function dataFrom() {
		return [
			['data', null, null, null, [['table' => '`data`', 'alias' => null]], '`data`'],
			['data', 't', null, null, [['table' => '`data`', 'alias' => 't']], '`data` t'],
			['data1', null, 'data2', null, [
				['table' => '`data1`', 'alias' => null],
				['table' => '`data2`', 'alias' => null]
			], '`data1`, `data2`'],
			['data', 't1', 'data', 't2', [
				['table' => '`data`', 'alias' => 't1'],
				['table' => '`data`', 'alias' => 't2']
			], '`data` t1, `data` t2'],
		];
	}

	/**
	 * @dataProvider dataFrom
	 *
	 * @param string $table1Name
	 * @param string $table1Alias
	 * @param string $table2Name
	 * @param string $table2Alias
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testFrom($table1Name, $table1Alias, $table2Name, $table2Alias, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->from($table1Name, $table1Alias);
		if ($table2Name !== null) {
			$this->queryBuilder->from($table2Name, $table2Alias);
		}

		$this->assertSame(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('from')
		);

		$this->assertSame(
			'SELECT  FROM ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataJoin() {
		return [
			[
				'd1', 'data2', null, null,
				['d1' => [['joinType' => 'inner', 'joinTable' => '`data2`', 'joinAlias' => null, 'joinCondition' => null]]],
				'`data1` d1 INNER JOIN `data2`  ON '
			],
			[
				'd1', 'data2', 'd2', null,
				['d1' => [['joinType' => 'inner', 'joinTable' => '`data2`', 'joinAlias' => 'd2', 'joinCondition' => null]]],
				'`data1` d1 INNER JOIN `data2` d2 ON '
			],
			[
				'd1', 'data2', 'd2', 'd1.`field1` = d2.`field2`',
				['d1' => [['joinType' => 'inner', 'joinTable' => '`data2`', 'joinAlias' => 'd2', 'joinCondition' => 'd1.`field1` = d2.`field2`']]],
				'`data1` d1 INNER JOIN `data2` d2 ON d1.`field1` = d2.`field2`'
			],

		];
	}

	/**
	 * @dataProvider dataJoin
	 *
	 * @param string $fromAlias
	 * @param string $tableName
	 * @param string $tableAlias
	 * @param string $condition
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testJoin($fromAlias, $tableName, $tableAlias, $condition, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->from('data1', 'd1');
		$this->queryBuilder->join(
			$fromAlias,
			$tableName,
			$tableAlias,
			$condition
		);

		$this->assertSame(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('join')
		);

		$this->assertSame(
			'SELECT  FROM ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	/**
	 * @dataProvider dataJoin
	 *
	 * @param string $fromAlias
	 * @param string $tableName
	 * @param string $tableAlias
	 * @param string $condition
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testInnerJoin($fromAlias, $tableName, $tableAlias, $condition, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->from('data1', 'd1');
		$this->queryBuilder->innerJoin(
			$fromAlias,
			$tableName,
			$tableAlias,
			$condition
		);

		$this->assertSame(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('join')
		);

		$this->assertSame(
			'SELECT  FROM ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataLeftJoin() {
		return [
			[
				'd1', 'data2', null, null,
				['d1' => [['joinType' => 'left', 'joinTable' => '`data2`', 'joinAlias' => null, 'joinCondition' => null]]],
				'`data1` d1 LEFT JOIN `data2`  ON '
			],
			[
				'd1', 'data2', 'd2', null,
				['d1' => [['joinType' => 'left', 'joinTable' => '`data2`', 'joinAlias' => 'd2', 'joinCondition' => null]]],
				'`data1` d1 LEFT JOIN `data2` d2 ON '
			],
			[
				'd1', 'data2', 'd2', 'd1.`field1` = d2.`field2`',
				['d1' => [['joinType' => 'left', 'joinTable' => '`data2`', 'joinAlias' => 'd2', 'joinCondition' => 'd1.`field1` = d2.`field2`']]],
				'`data1` d1 LEFT JOIN `data2` d2 ON d1.`field1` = d2.`field2`'
			],
		];
	}

	/**
	 * @dataProvider dataLeftJoin
	 *
	 * @param string $fromAlias
	 * @param string $tableName
	 * @param string $tableAlias
	 * @param string $condition
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testLeftJoin($fromAlias, $tableName, $tableAlias, $condition, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->from('data1', 'd1');
		$this->queryBuilder->leftJoin(
			$fromAlias,
			$tableName,
			$tableAlias,
			$condition
		);

		$this->assertSame(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('join')
		);

		$this->assertSame(
			'SELECT  FROM ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataRightJoin() {
		return [
			[
				'd1', 'data2', null, null,
				['d1' => [['joinType' => 'right', 'joinTable' => '`data2`', 'joinAlias' => null, 'joinCondition' => null]]],
				'`data1` d1 RIGHT JOIN `data2`  ON '
			],
			[
				'd1', 'data2', 'd2', null,
				['d1' => [['joinType' => 'right', 'joinTable' => '`data2`', 'joinAlias' => 'd2', 'joinCondition' => null]]],
				'`data1` d1 RIGHT JOIN `data2` d2 ON '
			],
			[
				'd1', 'data2', 'd2', 'd1.`field1` = d2.`field2`',
				['d1' => [['joinType' => 'right', 'joinTable' => '`data2`', 'joinAlias' => 'd2', 'joinCondition' => 'd1.`field1` = d2.`field2`']]],
				'`data1` d1 RIGHT JOIN `data2` d2 ON d1.`field1` = d2.`field2`'
			],
		];
	}

	/**
	 * @dataProvider dataRightJoin
	 *
	 * @param string $fromAlias
	 * @param string $tableName
	 * @param string $tableAlias
	 * @param string $condition
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testRightJoin($fromAlias, $tableName, $tableAlias, $condition, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->from('data1', 'd1');
		$this->queryBuilder->rightJoin(
			$fromAlias,
			$tableName,
			$tableAlias,
			$condition
		);

		$this->assertSame(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('join')
		);

		$this->assertSame(
			'SELECT  FROM ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataSet() {
		return [
			['column1', new Literal('value'), null, null, ['`column1` = value'], '`column1` = value'],
			['column1', new Parameter(':param'), null, null, ['`column1` = :param'], '`column1` = :param'],
			['column1', 'column2', null, null, ['`column1` = `column2`'], '`column1` = `column2`'],
			['column1', 'column2', 'column3', new Literal('value'), ['`column1` = `column2`', '`column3` = value'], '`column1` = `column2`, `column3` = value'],
		];
	}

	/**
	 * @dataProvider dataSet
	 *
	 * @param string $partOne1
	 * @param string $partOne2
	 * @param string $partTwo1
	 * @param string $partTwo2
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testSet($partOne1, $partOne2, $partTwo1, $partTwo2, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->update('data');
		$this->queryBuilder->set($partOne1, $partOne2);
		if ($partTwo1 !== null) {
			$this->queryBuilder->set($partTwo1, $partTwo2);
		}

		$this->assertSame(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('set')
		);

		$this->assertSame(
			'UPDATE `data` SET ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataWhere() {
		return [
			[['where1'], new CompositeExpression('AND', ['where1']), 'where1'],
			[['where1', 'where2'], new CompositeExpression('AND', ['where1', 'where2']), '(where1) AND (where2)'],
		];
	}

	/**
	 * @dataProvider dataWhere
	 *
	 * @param array $whereArguments
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testWhere($whereArguments, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->select('column');
		call_user_func_array(
			[$this->queryBuilder, 'where'],
			$whereArguments
		);

		$this->assertEquals(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('where')
		);

		$this->assertSame(
			'SELECT `column` FROM  WHERE ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	/**
	 * @dataProvider dataWhere
	 *
	 * @param array $whereArguments
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testAndWhere($whereArguments, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->select('column');
		call_user_func_array(
			[$this->queryBuilder, 'andWhere'],
			$whereArguments
		);

		$this->assertEquals(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('where')
		);

		$this->assertSame(
			'SELECT `column` FROM  WHERE ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataOrWhere() {
		return [
			[['where1'], new CompositeExpression('OR', ['where1']), 'where1'],
			[['where1', 'where2'], new CompositeExpression('OR', ['where1', 'where2']), '(where1) OR (where2)'],
		];
	}

	/**
	 * @dataProvider dataOrWhere
	 *
	 * @param array $whereArguments
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testOrWhere($whereArguments, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->select('column');
		call_user_func_array(
			[$this->queryBuilder, 'orWhere'],
			$whereArguments
		);

		$this->assertEquals(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('where')
		);

		$this->assertSame(
			'SELECT `column` FROM  WHERE ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataGroupBy() {
		return [
			[['column1'], ['`column1`'], '`column1`'],
			[['column1', 'column2'], ['`column1`', '`column2`'], '`column1`, `column2`'],
		];
	}

	/**
	 * @dataProvider dataGroupBy
	 *
	 * @param array $groupByArguments
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testGroupBy($groupByArguments, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->select('column');
		call_user_func_array(
			[$this->queryBuilder, 'groupBy'],
			$groupByArguments
		);

		$this->assertEquals(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('groupBy')
		);

		$this->assertSame(
			'SELECT `column` FROM  GROUP BY ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataAddGroupBy() {
		return [
			[['column2'], ['`column1`', '`column2`'], '`column1`, `column2`'],
			[['column2', 'column3'], ['`column1`', '`column2`', '`column3`'], '`column1`, `column2`, `column3`'],
		];
	}

	/**
	 * @dataProvider dataAddGroupBy
	 *
	 * @param array $groupByArguments
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testAddGroupBy($groupByArguments, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->select('column');
		$this->queryBuilder->groupBy('column1');
		call_user_func_array(
			[$this->queryBuilder, 'addGroupBy'],
			$groupByArguments
		);

		$this->assertEquals(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('groupBy')
		);

		$this->assertSame(
			'SELECT `column` FROM  GROUP BY ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataSetValue() {
		return [
			['column', 'value', ['`column`' => 'value'], '(`column`) VALUES(value)'],
		];
	}

	/**
	 * @dataProvider dataSetValue
	 *
	 * @param string $column
	 * @param string $value
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testSetValue($column, $value, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->insert('data');
		$this->queryBuilder->setValue($column, $value);

		$this->assertEquals(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('values')
		);

		$this->assertSame(
			'INSERT INTO `data` ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	/**
	 * @dataProvider dataSetValue
	 *
	 * @param string $column
	 * @param string $value
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testValues($column, $value, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->insert('data');
		$this->queryBuilder->values([
			$column => $value,
		]);

		$this->assertEquals(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('values')
		);

		$this->assertSame(
			'INSERT INTO `data` ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataHaving() {
		return [
			[['condition1'], new CompositeExpression('AND', ['condition1']), 'HAVING condition1'],
			[['condition1', 'condition2'], new CompositeExpression('AND', ['condition1', 'condition2']), 'HAVING (condition1) AND (condition2)'],
			[
				[new CompositeExpression('OR', ['condition1', 'condition2'])],
				new CompositeExpression('OR', ['condition1', 'condition2']),
				'HAVING (condition1) OR (condition2)'
			],
			[
				[new CompositeExpression('AND', ['condition1', 'condition2'])],
				new CompositeExpression('AND', ['condition1', 'condition2']),
				'HAVING (condition1) AND (condition2)'
			],
		];
	}

	/**
	 * @dataProvider dataHaving
	 *
	 * @param array $havingArguments
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testHaving($havingArguments, $expectedQueryPart, $expectedQuery) {
		call_user_func_array(
			[$this->queryBuilder, 'having'],
			$havingArguments
		);

		$this->assertEquals(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('having')
		);

		$this->assertSame(
			'SELECT  FROM  ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataAndHaving() {
		return [
			[['condition2'], new CompositeExpression('AND', ['condition1', 'condition2']), 'HAVING (condition1) AND (condition2)'],
			[['condition2', 'condition3'], new CompositeExpression('AND', ['condition1', 'condition2', 'condition3']), 'HAVING (condition1) AND (condition2) AND (condition3)'],
			[
				[new CompositeExpression('OR', ['condition2', 'condition3'])],
				new CompositeExpression('AND', ['condition1', new CompositeExpression('OR', ['condition2', 'condition3'])]),
				'HAVING (condition1) AND ((condition2) OR (condition3))'
			],
			[
				[new CompositeExpression('AND', ['condition2', 'condition3'])],
				new CompositeExpression('AND', ['condition1', new CompositeExpression('AND', ['condition2', 'condition3'])]),
				'HAVING (condition1) AND ((condition2) AND (condition3))'
			],
		];
	}

	/**
	 * @dataProvider dataAndHaving
	 *
	 * @param array $havingArguments
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testAndHaving($havingArguments, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->having('condition1');
		call_user_func_array(
			[$this->queryBuilder, 'andHaving'],
			$havingArguments
		);

		$this->assertEquals(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('having')
		);

		$this->assertSame(
			'SELECT  FROM  ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataOrHaving() {
		return [
			[['condition2'], new CompositeExpression('OR', ['condition1', 'condition2']), 'HAVING (condition1) OR (condition2)'],
			[['condition2', 'condition3'], new CompositeExpression('OR', ['condition1', 'condition2', 'condition3']), 'HAVING (condition1) OR (condition2) OR (condition3)'],
			[
				[new CompositeExpression('OR', ['condition2', 'condition3'])],
				new CompositeExpression('OR', ['condition1', new CompositeExpression('OR', ['condition2', 'condition3'])]),
				'HAVING (condition1) OR ((condition2) OR (condition3))'
			],
			[
				[new CompositeExpression('AND', ['condition2', 'condition3'])],
				new CompositeExpression('OR', ['condition1', new CompositeExpression('AND', ['condition2', 'condition3'])]),
				'HAVING (condition1) OR ((condition2) AND (condition3))'
			],
		];
	}

	/**
	 * @dataProvider dataOrHaving
	 *
	 * @param array $havingArguments
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testOrHaving($havingArguments, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->having('condition1');
		call_user_func_array(
			[$this->queryBuilder, 'orHaving'],
			$havingArguments
		);

		$this->assertEquals(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('having')
		);

		$this->assertSame(
			'SELECT  FROM  ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataOrderBy() {
		return [
			['column', null, ['`column` ASC'], 'ORDER BY `column` ASC'],
			['column', 'ASC', ['`column` ASC'], 'ORDER BY `column` ASC'],
			['column', 'DESC', ['`column` DESC'], 'ORDER BY `column` DESC'],
		];
	}

	/**
	 * @dataProvider dataOrderBy
	 *
	 * @param string $sort
	 * @param string $order
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testOrderBy($sort, $order, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->orderBy($sort, $order);

		$this->assertEquals(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('orderBy')
		);

		$this->assertSame(
			'SELECT  FROM  ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}

	public function dataAddOrderBy() {
		return [
			['column2', null, null, ['`column1` ASC', '`column2` ASC'], 'ORDER BY `column1` ASC, `column2` ASC'],
			['column2', null, 'ASC', ['`column1` ASC', '`column2` ASC'], 'ORDER BY `column1` ASC, `column2` ASC'],
			['column2', null, 'DESC', ['`column1` DESC', '`column2` ASC'], 'ORDER BY `column1` DESC, `column2` ASC'],
			['column2', 'ASC', null, ['`column1` ASC', '`column2` ASC'], 'ORDER BY `column1` ASC, `column2` ASC'],
			['column2', 'ASC', 'ASC', ['`column1` ASC', '`column2` ASC'], 'ORDER BY `column1` ASC, `column2` ASC'],
			['column2', 'ASC', 'DESC', ['`column1` DESC', '`column2` ASC'], 'ORDER BY `column1` DESC, `column2` ASC'],
			['column2', 'DESC', null, ['`column1` ASC', '`column2` DESC'], 'ORDER BY `column1` ASC, `column2` DESC'],
			['column2', 'DESC', 'ASC', ['`column1` ASC', '`column2` DESC'], 'ORDER BY `column1` ASC, `column2` DESC'],
			['column2', 'DESC', 'DESC', ['`column1` DESC', '`column2` DESC'], 'ORDER BY `column1` DESC, `column2` DESC'],
		];
	}

	/**
	 * @dataProvider dataAddOrderBy
	 *
	 * @param string $sort2
	 * @param string $order2
	 * @param string $order1
	 * @param array $expectedQueryPart
	 * @param string $expectedQuery
	 */
	public function testAddOrderBy($sort2, $order2, $order1, $expectedQueryPart, $expectedQuery) {
		$this->queryBuilder->orderBy('column1', $order1);
		$this->queryBuilder->addOrderBy($sort2, $order2);

		$this->assertEquals(
			$expectedQueryPart,
			$this->queryBuilder->getQueryPart('orderBy')
		);

		$this->assertSame(
			'SELECT  FROM  ' . $expectedQuery,
			$this->queryBuilder->getSQL()
		);
	}
}
