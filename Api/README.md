# Api
--------

Situation:

- Api is fixed (always there)
- Core is fixed (always there)


- Module is possible there (install/uninstall)
- Extension is possible there (install/uninstall)
- Plugin is possible there (install/uninstall)

## Structure
------------

    Directory: Api > Type
    Instance: {Type}.php (Interface & Class)
    Interface: Define Category

- Interface used by
	- Type
- Instance used by
	- Api
	- ```Api::{Type}()->{Category:Instance}```
