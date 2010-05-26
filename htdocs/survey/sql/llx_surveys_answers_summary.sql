-- ============================================================================
-- Copyright (C) 2007 Laurent Destailleur  <eldy@users.sourceforge.net>
--
-- This program is free software; you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation; either version 2 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program; if not, write to the Free Software
-- Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
--
-- $Id: llx_surveys_answers_summary.sql,v 1.1 2009/11/11 23:49:12 eldy Exp $
-- ===========================================================================

CREATE TABLE llx_surveys_answers_summary (
  fk_question       integer PRIMARY KEY,
  nb_rep1           decimal(10,0) NOT NULL default '0',
  nb_rep2           decimal(10,0) default NULL,
  nb_rep3           decimal(10,0) default NULL,
  nb_rep4           decimal(10,0) default NULL,
  tot_rep1          decimal(10,0) NOT NULL default '0',
  tot_rep2          decimal(10,0) default NULL,
  tot_rep3          decimal(10,0) default NULL,
  tot_rep4          decimal(10,0) default NULL
)type=innodb;