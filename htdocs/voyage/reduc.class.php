<?php
/* Copyright (C) 2001-2002 Rodolphe Quiedeville <rodolphe@quiedeville.org>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 *
 * $Id: reduc.class.php,v 1.2 2010/05/08 20:54:03 eldy Exp $
 */

class Reduc {
	var $id;
	var $price;
	var $label;

	function Reduc($DB, $rowid=0) {
		global $config;

		$this->db = $DB;
		$this->rowid = $rowid;

		return 1;
	}

	function fetch($id)
	{
		$sql = "SELECT b.rowid,b.date_debut as debut,b.date_fin as fin, b.amount, b.label";
		$sql.= " FROM ".MAIN_DB_PREFIX."voyage_reduc as b WHERE rowid = $id";

		$result = $this->db->query($sql);

		if ($result)
		{
			if ($this->db->num_rows())
			{
				$obj = $this->db->fetch_object($result);

				$this->id = $obj->rowid;
				$this->price = $obj->amount;
				$this->label = $obj->label;
			}
			$this->db->free();
		}
	}


}

?>