<?php
/**
 * @author Joas Schilling <nickvergessen@owncloud.com>
 *
 * @copyright Copyright (c) 2016, ownCloud, Inc.
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

namespace OC\DB\QueryBuilder;


use OCP\DB\QueryBuilder\ILiteral;
use OCP\DB\QueryBuilder\IParameter;
use OCP\DB\QueryBuilder\IQueryBuilder;

class OCIExpressionBuilder extends ExpressionBuilder {

	/**
	 * @param mixed $column
	 * @param mixed|null $type
	 * @return array|QueryFunction|string
	 */
	protected function prepareColumn($column, $type) {
		if ($type === IQueryBuilder::PARAM_STR && !is_array($column) && !($column instanceof IParameter) && !($column instanceof ILiteral)) {
			$column = $this->helper->quoteColumnName($column);
			$column = new QueryFunction('to_char(' . $column . ')');
		} else {
			$column = $this->helper->quoteColumnNames($column);
		}
		return $column;
	}

	/**
	 * @inheritdoc
	 */
	public function comparison($x, $operator, $y, $type = null) {
		$x = $this->prepareColumn($x, $type);
		$y = $this->prepareColumn($y, $type);

		return $this->expressionBuilder->comparison($x, $operator, $y);
	}

	/**
	 * @inheritdoc
	 */
	public function eq($x, $y, $type = null) {
		$x = $this->prepareColumn($x, $type);
		$y = $this->prepareColumn($y, $type);

		return $this->expressionBuilder->eq($x, $y);
	}

	/**
	 * @inheritdoc
	 */
	public function neq($x, $y, $type = null) {
		$x = $this->prepareColumn($x, $type);
		$y = $this->prepareColumn($y, $type);

		return $this->expressionBuilder->neq($x, $y);
	}

	/**
	 * @inheritdoc
	 */
	public function lt($x, $y, $type = null) {
		$x = $this->prepareColumn($x, $type);
		$y = $this->prepareColumn($y, $type);

		return $this->expressionBuilder->lt($x, $y);
	}

	/**
	 * @inheritdoc
	 */
	public function lte($x, $y, $type = null) {
		$x = $this->prepareColumn($x, $type);
		$y = $this->prepareColumn($y, $type);

		return $this->expressionBuilder->lte($x, $y);
	}

	/**
	 * @inheritdoc
	 */
	public function gt($x, $y, $type = null) {
		$x = $this->prepareColumn($x, $type);
		$y = $this->prepareColumn($y, $type);

		return $this->expressionBuilder->gt($x, $y);
	}

	/**
	 * @inheritdoc
	 */
	public function gte($x, $y, $type = null) {
		$x = $this->prepareColumn($x, $type);
		$y = $this->prepareColumn($y, $type);

		return $this->expressionBuilder->gte($x, $y);
	}

	/**
	 * @inheritdoc
	 */
	public function in($x, $y, $type = null) {
		$x = $this->prepareColumn($x, $type);
		$y = $this->prepareColumn($y, $type);

		return $this->expressionBuilder->in($x, $y);
	}

	/**
	 * @inheritdoc
	 */
	public function notIn($x, $y, $type = null) {
		$x = $this->prepareColumn($x, $type);
		$y = $this->prepareColumn($y, $type);

		return $this->expressionBuilder->notIn($x, $y);
	}
}
