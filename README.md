# redbeanphp-crud

Try for Redbeanphp, small &amp; simple tool to play with database (mysql)

## Parameters

**Get storage**
```text
# by id
storage.php?id=bar

# get all (left empty)
storage.php
```

**Add storage**
```javascript
// body: { name: "storage name" }

const reqInit = {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        name: 'storage 1',
    })
}
```

**Remove storage**
```js
// body: { removeId: "storage_id" }

const init = {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify{
        removeId: 'bar'
    }
}
```

## GET

```js
const url = new URL('http://localhost/redbeanphp-crud/storage.php')
const request = new Request(url.toString())

// GET Request init
const reqInit = {
    method: 'GET',
    headers: {
        'Accept': 'application/json',
    }
}

// GET Request
const data = await fetch(request, reqInit).then(response => response.json())
```

## POST

```js
// API url
const url = new URL('http://localhost/redbeanphp-crud/storage.php')
const request = new Request(url.toString())


// POST Request init
const reqInit = {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        name: 'storage 1',
    })
}

// POST Request
const data = await fetch(request, reqInit).then(response => response.json())
```
