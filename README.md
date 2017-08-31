# PermissionUtils

Copyright (c) 2017 Institut fuer Lern-Innovation, Friedrich-Alexander-Universitaet Erlangen-Nuernberg
GPLv3, see LICENSE

Author: Fred Neumann <fred.neumann@fau.de>
Supported versions: ILIAS 5.2

**This add-on is provided WITHOUT WARRANTY and should be used by experienced ILIAS admins. Please backup your database before!** 

## Objective

New ILIAS versions or ILIAS plugins may introduce new object types that need a setting of their default permissions in existing roles and role templates. Additionally the existing container objects need an initialization of the create permissions for the new types. Setting these manually can be expensive or even impossible, if an installation uses many local roles.

The solution of this add-on tries to automate this by copying the permissions of the new object types from existing similar object types. An InteractiveVideo plugin, for example may be seen as similar to a MediaCast. Therefore everyone who has the create permission for a MediaCast should be able to create an InteractiveVideo. And everyone who has write permission in a MediaCast should have write permission in an InteractiveVideo if objects of this type are already created.

## Installation and Usage

* Clone the PermissionUtils directly under the Customizing directory of your ILIAS installation.
* Extend *patches/class.ilPermissionPatches.php* by creating your own function. You may copy initInteractiveVideo() as an Example.
* Add a patch call of your function in apply.php and uncomment it.
* Run apply.php from the command line: 
```
php apply.php username password client_id
```

## Writing Patches

The following functions of ilPermissionUtils will help you to write your own permission initializations:

The following functions are available:
* **copyDefaultPermission()** copies a single default permission in all roles and role templates, including local policies. Source type and operation may be different from target type and operation but normally the operation is the same. This is typically used to initialize read and write permissions.
* **copyDefaultPermissions()** copies default permissions for a couple of object types. Here the source type and target type are the same, but the operations can differ. This is typically used to initialize the default create permissions.
* **copyPermissions()** copies actual permissions in objects of given types. The signature is the same as for copyDefaultPermissions(). This is typically used to initialize the actual create permissions.



