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
    Interface: Define Unit

- Interface used by
	- Type
- Instance used by
	- Api
	- ```Api::api{Type}()->unit{Unit:Instance}```
