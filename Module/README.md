# Module
--------

Type:

- Bundled (Worker: Module)
- Repository (Worker: Extension/Plugin)

Situation:

- Module-Api is fixed (always there)


- Module is possible there (install/uninstall)
- Extension is possible there (install/uninstall)

## Structure
------------

    Directory: Module > Category > Name > ..
    Instance: Api.php (Interface & Class)
    Interface: Define Api

    Class-Location
    Api: Module > Category > Name > Api > ..
    Worker: Module > Category > Name > Source > .. (Type: Bundled)

- Interface used by
	- Module
	- Extension
	- Plugin
- Instance used by
	- Module Api
	- ```Api::Module()->{Category}()->{Name:Instance}()->{Method}```

## Api
------

Location: ```Module > Category > Name > Api > ..```

## Worker
---------

### Module (Bundled)

Location: ```Module > Category > Name > Source > ..```

### Extension (Repository)

Location: ```Extension > Category > Name > Source > ..```

### Plugin (Repository)

Location: ```Plugin > Category > Name > Source > ..```
