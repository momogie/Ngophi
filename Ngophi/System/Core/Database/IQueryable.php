<?php

namespace System\Core\Database;

interface IQueryable
{

	public function Select($select = null);
	public function Table($tablename,$alias = null);
	public function From($tablename,$alias = null);
	public function Join($tablename,$alias = null,$on = null);
	public function LeftJoin($tablename,$alias = null,$on = null);
	public function RightJoin($tablename,$alias = null,$on = null);
	public function FullJoin($tablename,$alias = null,$on = null);
	public function CrossJoin($tablename,$alias = null,$on = null);
	public function On($on);
	public function Where($key1,$key2,$key3);
	public function OrderBy($key,$order = 'ASC');
	public function OrderNext($key,$order = 'ASC');
	public function GroupBy($key,$order = 'ASC');

	public function First($select = null);
	public function Get($select = null);
	public function All($select = null);
	public function Delete();
	public function Insert($tablename,array $data);
	public function Update($tablename,array $data,$where = null);


	public function Any();
	public function Count();
	public function Sum($colname = '*');
	public function Max($colname = '*');
	public function Min($colname = '*');
	public function Avg($colname = '*');

}