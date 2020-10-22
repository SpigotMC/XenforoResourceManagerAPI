## XenforoResourceManagerAPI
This project aims to safely expose information from the [SpigotMC](https://spigotmc.org) website in a machine-readable format for use in projects and other systems.

### Current Capabilities
| Action                 | Description                                                                                         |
|------------------------|-----------------------------------------------------------------------------------------------------|
| listResources          | get information about all resources in the system, optionally specifying a category ID and/or a page|             
| getResource            | get information about a resource by its ID                                                          |
| getResourcesByAuthor   | get information about all resources created by a specific author by the user id                     |
| listResourceCategories | get information about available resource categories; useful for `listResources` later on            |
| getResourceUpdate      | get information about a specific resource update by its id                                          |
| getResourceUpdates     | get information about all of the updates for a specific resource by the resource id                 |
| getAuthor              | get information about an author by the user id                                                      |
| findAuthor             | get information about an author by the username (**exact match only**)                              |

### How To Use
All requests must currently be sent via **GET** to https://api.spigotmc.org/simple/0.2/index.php. To get started, attach a **GET** parameter `action` specifying which operation you'd like to perform (seen above). Then, attach the action's **GET** parameter(s) (seen above, currently only `id`).

### Example
Here are examples of current capabilities:

#### listResources
##### Parameters: `cat`, optional, ID from `listResourceCategories`; `page`, optional, defaults to `1`
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=listResources&cat=4&page=2
##### Response:
```json
{
  "coming": "soon"
}
```

#### getResource
##### Parameters: `id`, required, the resource id
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=getResource&id=2
##### Response:
```json
{
  "coming": "soon"
}
```

#### getResourcesByAuthor
##### Parameters: `id`, required, the author id
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=getResourcesByAuthor&id=1
##### Response (truncated):
```json
{
  "coming": "soon"
}
```

#### listResourceCategories
##### Parameters: **none**
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=listResourceCategories
##### Response:
```json
{
  "coming": "soon"
}
```

#### getResourceUpdate
##### Parameters: `id`, required, the resource update id
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=getResourceUpdate&id=2
##### Response:
```json
{
  "coming": "soon"
}
```

#### getResourceUpdates
##### Parameters: `id`, required, the resource id
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=getResourceUpdates&id=2
##### Response:
```json
{
  "coming": "soon"
}
```

#### getAuthor
##### Parameters: `id`, required, the user id
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=getAuthor&id=1
##### Response:
```json
{
  "coming": "soon"
}
```

#### findAuthor
##### Parameters: `name`, required, should exactly match the Spigot username (escape if necessary)
##### Request: https://api.spigotmc.org/simple/0.2/index.php?action=findAuthor&name=simpleauthority
##### Response:
```json
{
  "coming": "soon"
}
```