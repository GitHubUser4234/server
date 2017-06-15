<?php
/**
 * @copyright Copyright (c) 2017 Robin Appelman <robin@icewind.nl>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OC\DB\QueryBuilder\FunctionBuilder;

use OC\DB\QueryBuilder\QueryFunction;
use OC\DB\QueryBuilder\QuoteHelper;
use OCP\DB\QueryBuilder\IFunctionBuilder;

class FunctionBuilder implements IFunctionBuilder {
	/** @var QuoteHelper */
	protected $helper;

	/**
	 * ExpressionBuilder constructor.
	 *
	 * @param QuoteHelper $helper
	 */
	public function __construct(QuoteHelper $helper) {
		$this->helper = $helper;
	}

	public function md5($input) {
		return new QueryFunction('MD5(' . $this->helper->quoteColumnName($input) . ')');
	}

	public function concat($x, $y) {
		return new QueryFunction('CONCAT(' . $this->helper->quoteColumnName($x) . ', ' . $this->helper->quoteColumnName($y) . ')');
	}

	public function substring($input, $start, $length = null) {
		if ($length) {
			return new QueryFunction('SUBSTR(' . $this->helper->quoteColumnName($input) . ', ' . $this->helper->quoteColumnName($start) . ', ' . $this->helper->quoteColumnName($length) . ')');
		} else {
			return new QueryFunction('SUBSTR(' . $this->helper->quoteColumnName($input) . ', ' . $this->helper->quoteColumnName($start) . ')');
		}
	}

	public function sum($field) {
		return new QueryFunction('SUM(' . $this->helper->quoteColumnName($field) . ')');
	}
}
