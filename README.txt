// --------------------------------------------------------------------------------
// @version 1.5 - readme.txt
// --------------------------------------------------------------------------------
// License GNU/LGPL - March 2021
// @author António Lira Fernandes - alf@esmonserrate.org
// https://github.com/alfZone
// --------------------------------------------------------------------------------




0 - Sommaire
============
    1 - Introduction
    2 - What's new
    3 - Corrected bugs
    4 - Known bugs or limitations
    5 - License
    6 - Warning
    7 - Documentation
    8 - Author
    9 - Contribute

1 - Introduction
================

  This class handles all file operations. It presents several methods for manipulating the file system. The methods are in Portuguese

2 - What's new
==============

      - No new feature


3 - Corrected bugs
==================

  Corrected in Version 2.0 :
    - Corrected : During an extraction, if a call-back fucntion is used and try to skip
                  a file, all the extraction process is stopped. 

  Corrected in Version 1.3 :
    - Corrected : Support of static synopsis for method extract() is broken.
    - Corrected : invalid size of archive content field (0xFF) should be (0xFFFF).
    - Corrected : When an extract is done with a remove_path parameter, the entry for
      the directory with exactly the same path is not skipped/filtered.
    - Corrected : extractByIndex() and deleteByIndex() were not managing index in the
      right way. For example indexes '1,3-5,11' will only extract files 1 and 11. This
      is due to a sort of the index resulting table that puts 11 before 3-5 (sort on
      string and not interger). The sort is temporarilly removed, this means that
      you must provide a sorted list of index ranges.

  Corrected in Version 1.2 :

    - Nothing.

  Corrected in Version 1.1.2 :

    - Corrected : Winzip is unable to delete or add new files in a PclZip created archives.

  Corrected in Version 1.1.1 :

    - Corrected : When archived file is not compressed (0% compression), the
      extract method fails.

  Corrected in Version 1.1 :

    - Corrected : Adding a complete tree of folder may result in a bad archive
      creation.

  Corrected in Version 1.0.1 :

    - Corrected : Error while compressing files greater than PCLZIP_READ_BLOCK_SIZE (default=1024).


4 - Known bugs or limitations
=============================

  Please publish bugs reports in SourceForge :
    http://sourceforge.net/tracker/?group_id=40254&atid=427564

  In Version 2.x :
    - PclZip does only support file uncompressed or compressed with deflate (compression method 8)
    - PclZip does not support password protected zip archive
    - Some concern were seen when changing mtime of a file while archiving. 
      Seems to be linked to Daylight Saving Time (PclTest_changing_mtime).

  In Version 1.2 :

    - merge() methods does not check for duplicate files or last date of modifications.

  In Version 1.1 :

    - Limitation : Using 'extract' fields in the file header in the zip archive is not supported.
    - WinZip is unable to delete a single file in a PclZip created archive. It is also unable to
      add a file in a PclZip created archive. (Corrected in v.1.2)

  In Version 1.0.1 :

    - Adding a complete tree of folder may result in a bad archive
      creation. (Corrected in V.1.1).
    - Path given to methods must be in the unix format (/) and not the Windows format (\).
      Workaround : Use only / directory separators.
    - PclZip is using temporary files that are sometime the name of the file with a .tmp or .gz
      added suffix. Files with these names may already exist and may be overwritten.
      Workaround : none.
    - PclZip does not check if the zlib extension is present. If it is absent, the zip
      file is not created and the lib abort without warning.
      Workaround : enable the zlib extension on the php install

  In Version 1.0 :

    - Error while compressing files greater than PCLZIP_READ_BLOCK_SIZE (default=1024).
      (Corrected in v.1.0.1)
    - Limitation : Multi-disk zip archive are not supported.


5 - License
===========

  Since version 1.1.2, PclZip Library is released under GNU/LGPL license.
  This library is free, so you can use it at no cost.

  HOWEVER, if you release a script, an application, a library or any kind of
  code using PclZip library (or a part of it), YOU MUST :
  - Indicate in the documentation (or a readme file), that your work
    uses PclZip Library, and make a reference to the author and the web site
    http://www.phpconcept.net
  - Gives the ability to the final user to update the PclZip libary.

  I will also appreciate that you send me a mail (vincent@phpconcept.net), just to
  be aware that someone is using PclZip.

  For more information about GNU/LGPL license : http://www.gnu.org

6 - Warning
=================

  This library and the associated files are non commercial, non professional work.
  It should not have unexpected results. However if any damage is caused by this software
  the author can not be responsible.
  The use of this software is at the risk of the user.

7 - Documentation
=================
  PclZip User Manuel is available in English on PhpConcept : http://www.phpconcept.net/pclzip/man/en/index.php
  A Russian translation was done by Feskov Kuzma : http://php.russofile.ru/ru/authors/unsort/zip/

8 - Author
==========

  This software was written by Vincent Blavet (vincent@phpconcept.net) on its leasure time.

9 - Contribute
==============
  If you want to contribute to the development of PclZip, please contact vincent@phpconcept.net.
  If you can help in financing PhpConcept hosting service, please go to
  http://www.phpconcept.net/soutien.php
