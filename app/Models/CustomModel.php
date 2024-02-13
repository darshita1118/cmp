<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\BaseBuilder;

/**
 *
 */
class CustomModel extends Model
{
    protected $db = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        //'password' => '',
        //'database' => '',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];


    public function __construct($dbname)
    {
        parent::__construct();
        if ($dbname !== null) {
            $this->db->setDatabase($dbname);
        } else {
            $this->db->setDatabase(session('db'));
        }
    }

    public function customQuery($query)
    {

        return $this->db->query($query)->getResultArray();
    }

    function getlist($table, $where = false, $select = '*', $innerjoin = false, $orderby = false, $limit = false)
    {
        //;
        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }
        if ($select != '*') {
            $builder->select($select);
        }
        if ($innerjoin) {
            $builder->join($innerjoin['tablenamesecond'], $innerjoin['tablefields']);
        }

        if ($where) {
            $builder->where($where);
        }

        if ($orderby) {
            $builder->orderBy($orderby['key'], $orderby['value']);
        }
        if ($limit) {
            if (is_array($limit)) {
                if (count($limit) == 2) {
                    $builder->limit($limit[0], $limit[1]);
                } else {
                    $builder->limit($limit[0]);
                }
            } else {
                $builder->limit($limit);
            }
        }

        return $builder->get()->getResult('array');
    }

    function updatedata($table, $where = false, $data)
    {

        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }

        if ($where) {
            $builder->where($where);
        } else {
            echo 'Please Given Where Clause';
            die();
        }
        return $builder->update($data);
    }

    function deletedata($table, $where, $deletetype = 'soft', $data = false)
    {

        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }

        if ($where) {
            $builder->where($where);
        } else {
            echo 'Please Given Where Clause';
            die();
        }
        if ($deletetype == 'hard') {
            return $builder->delete();
        }
        return $builder->update($data);
    }

    function insertdata($table, $data)
    {

        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }

        return $builder->insert($data);
    }

    // inner joinvy
    function getlistbywherein($table, $select = '*', $innerjoin = false, $wherein = false, $where = false, $orderby = false)
    {

        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }
        if ($select != '*') {
            $builder->select($select);
        }
        if ($innerjoin) {
            $builder->join($innerjoin['tablenamesecond'], $innerjoin['tablefields']);
        }
        if ($where) {
            $builder->where($where);
        }
        if ($wherein) {
            $builder->whereIn($wherein['table1feild'], function (BaseBuilder $builder) use ($wherein) {
                $builder->select($wherein['table2field'])->from($wherein['table2name']);
                if ($wherein['where']) {
                    $builder->where($wherein['where']);
                }
                return $builder;
            });
        }


        if ($orderby) {
            $builder->orderBy($orderby['key'], $orderby['value']);
        }

        return $builder->get()->getResult('array');
    }



    function checkdata($table, $select = '*', $where)
    {
        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }
        if ($select != '*') {
            $builder->select($select);
        }
        if ($where) {
            $builder->where($where);
        } else {
            echo 'Please Given Where Clause Properly ';
            die();
        }
        return $builder->countAllResults();
    }

    function SelectSumOf($table, $selectsum, $where = false)
    {
        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }
        if ($selectsum != '*') {
            $builder->selectSum($selectsum);
        } else {
            echo 'Please Given Selectbox name';
            die();
        }
        if ($where) {
            $builder->where($where);
        } else {
            echo 'Please Given Where Clause Properly ';
            die();
        }
        return $builder->get()->getRowArray();
    }

    function getDistinctList($table, $select = false, $innerjoin = false, $wherein = false, $where = false, $orderby = false)
    {
        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }
        if ($select) {
            $builder->distinct()->select($select);
        } else {
            echo 'Please Given select entity name';
            die();
        }
        if ($innerjoin) {
            $builder->join($innerjoin['tablenamesecond'], $innerjoin['tablefields']);
        }
        if ($where) {
            $builder->where($where);
        }
        if ($wherein) {
            $builder->whereIn($wherein['table1feild'], function (BaseBuilder $builder) use ($wherein) {
                $builder->select($wherein['table2field'])->from($wherein['table2name']);
                if ($wherein['where']) {
                    $builder->where($wherein['where']);
                }
                return $builder;
            });
        }


        if ($orderby) {
            $builder->orderBy($orderby['key'], $orderby['value']);
        }

        return $builder->get()->getResult('array');
    }

    function getListWhereIn($table, $select = '*', $innerjoin = false, $wherein = false, $where = false, $orderby = false)
    {
        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }
        if ($select != '*') {
            $builder->select($select);
        }

        if ($innerjoin) {
            $builder->join($innerjoin['tablenamesecond'], $innerjoin['tablefields']);
        }
        if ($where) {
            $builder->where($where);
        }
        if ($wherein) {
            $builder->whereIn($wherein['tableFeildName'], $wherein['data']);
        }


        if ($orderby) {
            $builder->orderBy($orderby['key'], $orderby['value']);
        }

        return $builder->get()->getResult('array');
    }

    function getSearchList($table, $where = 'false', $select = '*', $innerjoin = false, $like = false)
    {
        //;
        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }
        if ($select != '*') {
            $builder->select($select);
        }
        if ($innerjoin) {
            $builder->join($innerjoin['tablenamesecond'], $innerjoin['tablefields']);
        }

        if ($where) {
            $builder->where($where);
        }

        if ($like) {
            $count = true;
            foreach ($like as $key => $value) {
                if ($count) {
                    $count = false;
                    $builder->like($key, $value);
                } else {
                    $builder->orLike($key, $value);
                }
            }
        }


        return $builder->get()->getResult('array');
    }





    function getCount($table, $where = false, $wherein = false)
    {
        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }
        if ($where) {
            $builder->where($where);
        }
        if ($wherein) {
            $builder->whereIn($wherein['table1feild'], function (BaseBuilder $builder) use ($wherein) {
                $builder->select($wherein['table2field'])->from($wherein['table2name']);
                if ($wherein['where']) {
                    $builder->where($wherein['where']);
                }
                return $builder;
            });
        }

        return $builder->countAllResults();
    }

    public function getlistByGroup($table, $select = '*', $innerjoin = false, $wherein = false, $where = false, $orderby = false, $group = false, $limit = false, $return = true)
    {
        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }
        if ($select != '*') {
            $builder->select($select);
        }
        if ($innerjoin) {
            $builder->join($innerjoin['tablenamesecond'], $innerjoin['tablefields']);
        }
        if ($wherein) {
            $builder->whereIn($wherein['tableFeildName'], $wherein['data']);
        }


        if ($where) {
            $builder->where($where);
        }
        if ($group) {
            $builder->groupBy($group);
        }

        if ($orderby) {
            $builder->orderBy($orderby['key'], $orderby['value']);
        }
        if ($limit) {
            if (is_array($limit)) {
                if (count($limit) == 2) {
                    $builder->limit($limit[0], $limit[1]);
                } else {
                    $builder->limit($limit[0]);
                }
            } else {
                $builder->limit($limit);
            }
        }
        if ($return) {
            return $builder->get()->getResult('array');
        } else {
            return $builder->get()->getRowArray();
        }
    }

    function updateWhereIn($table, $where = false, $wherein = false, $data)
    {
        if ($table) {
            $builder = $this->db->table($table);
        } else {
            echo 'Please Given Table name';
            die();
        }
        if ($where) {
            $builder->where($where);
        }
        if ($wherein) {
            $builder->whereIn($wherein['tableFeildName'], $wherein['data']);
        }

        return $builder->update($data);
    }
}
