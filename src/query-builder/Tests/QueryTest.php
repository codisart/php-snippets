<?php
declare(strict_types=1);

namespace QueryBuilder\Tests;

use PHPUnit\Framework\TestCase;
use QueryBuilder\From;
use QueryBuilder\Join\Equals;
use QueryBuilder\Query;
use QueryBuilder\Select;
use QueryBuilder\Table;
use QueryBuilder\Where;

class QueryTest extends TestCase
{
    public function testQuery()
    {
        $customers = new class('customers') extends Table {
            public function name() {
                return $this->column('name');
            }
            public function id() {
                return $this->column('id');
            }
            public function departement() {
                return $this->column('departement');
            }
            public function departementShouldBe(int $departement) {
                return new Where\Equals($this->departement(), (string) $departement);
            }
            
            public function joins(Table $orders){
                return $orders->from()->join($this->name, new Equals($orders->customerId(), $this->id()));
            }
        };
        
        $orders = new class('orders') extends Table {
            public function customerId() {
                return $this->column('customer_id');
            }
            public function id() {
                return $this->column('id');
            }
            public function valid() {
                return $this->column('valid');
            }
            public function shouldBeValid() {
                return new Where\Equals($this->column('valid'), 'TRUE');
            }
            public function total() {
                return $this->sum('price',as: 'total');
            }
        };
        
        $customerOrders = new class($orders, $customers) extends From {
            public function __construct($orders, $customers)
            {
                parent::__construct('orders');
                $this->join('customers', new Equals($orders->customerId(), $customers->id()));
            }
        };
        
        $select = new Select(
            $orders->total(),
            $customers->name(),
        );
        
        $validDepartements = Where::atLeastOne(
            $customers->departementShouldBe(14),
            $customers->departementShouldBe(15),
        );
        $where = Where::everyOnes(
            $orders->shouldBeValid(),
            $validDepartements,
        );
        
        $query = new Query($select, $customerOrders, $where);

        $sql = <<<SQL
SELECT
    SUM(orders.price) AS total,
    customers.name
FROM orders
    JOIN customers ON orders.customer_id = customers.id
WHERE orders.valid = TRUE AND (customers.departement = 14 OR customers.departement = 15)
;

SQL;
         self::assertSame($sql, (string) $query);
    }
}