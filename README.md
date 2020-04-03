##XenforoResourceManagerAPI
-----
This project aims to safely expose information from the [SpigotMC](https://spigotmc.org) website in a machine-readable format for use in projects and other systems.

### Current Capabilities
| Action               | Parameters          | Description                                                                                     |
|----------------------|---------------------|-------------------------------------------------------------------------------------------------|
| getResource          | **id**: resource id | get information about a [resource](https://www.spigotmc.org/resources/)                         |
| getResourcesByAuthor | **id**: author id   | get information about all [resources](https://www.spigotmc.org/resources/) by a specific author |
| getAuthor            | **id**: author id   | get information about an author    

### How To Use
All requests must currently be sent via **GET** to https://api.spigotmc.org/simple/0.1/index.php. To get started, attach a **GET** parameter `action` specifying which operation you'd like to perform (seen above). Then, attach the action's **GET** parameter(s) (seen above, currently only `id`).

### Example
Here are examples of current capabilities:

#### getResource
##### Request: https://api.spigotmc.org/simple/0.1/index.php?action=getResource&id=2
##### Response:
```json
{
  "id": "201",
  "title": "XenPermissions",
  "tag": "Hook your permissions into Xenforo!",
  "author": {
    "id": "1",
    "username": "md_5"
  },
  "premium": {
    "price": "0.00",
    "currency": ""
  },
  "stats": {
    "downloads": "938",
    "updates": "0",
    "reviews": "4",
    "rating": "4.5"
  }
}
```

### getResourcesByAuthor
#### Request: https://api.spigotmc.org/simple/0.1/index.php?action=getResourcesByAuthor&id=1
#### Response:
```json
[
  {
    "id": "201",
    "title": "XenPermissions",
    "tag": "Hook your permissions into Xenforo!",
    "author": {
      "id": "1",
      "username": "md_5"
    },
    "premium": {
      "price": "0.00",
      "currency": ""
    },
    "stats": {
      "downloads": "938",
      "updates": "0",
      "reviews": "4",
      "rating": "4.5"
    }
  },
  {
    "id": "342",
    "title": "iTag",
    "tag": "Performant and Reliable TagAPI Replacement",
    "author": {
      "id": "1",
      "username": "md_5"
    },
    "premium": {
      "price": "0.00",
      "currency": ""
    },
    "stats": {
      "downloads": "23521",
      "updates": "2",
      "reviews": "17",
      "rating": "4.41176"
    }
  },
  ...
]
```
*Please note, results were truncated.*

### getAuthor
#### Request: https://api.spigotmc.org/simple/0.1/index.php?action=getAuthor&id=1
#### Response:
```json
{
  "id": "1",
  "username": "md_5",
  "resource_count": "12",
  "avatar": {
    "info": "1545025664",
    "hash": "b53fd878a84d268da2b6456e0b96cae5"
  }
}
```