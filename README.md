<div align="center">

# 🔧 Mock API Server

**Lightweight PHP mock server for API testing & development — zero dependencies, config-driven**

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![License](https://img.shields.io/badge/license-MIT-green?style=flat-square)
![No Dependencies](https://img.shields.io/badge/dependencies-none-brightgreen?style=flat-square)

</div>

---

## 🎯 What is this?

A minimal PHP mock API server that responds to HTTP requests based on a JSON config file — no framework, no database, no setup overhead.

**Ideal for:**
- Frontend development when the real backend isn't ready
- Testing API clients without hitting production
- Simulating auth flows, file downloads, error responses
- CI/CD pipelines where you need a predictable API stub

---

## ✨ Features

| Feature | Description |
|---------|-------------|
| 📋 **Config-driven routing** | Define all routes in `api.json` — no code changes needed |
| 🔐 **Token authentication** | Protect routes with Bearer token auth per-route |
| 📂 **File download simulation** | Return files as response bodies for download testing |
| 📝 **Request logging** | Full log of headers, body, query params per request |
| ⚡ **Zero dependencies** | Just PHP 7.0+ — no Composer, no framework |
| 🔄 **All HTTP methods** | GET, POST, PUT, PATCH, DELETE support |

---

## 🚀 Quick Start

```bash
# 1. Clone
git clone https://github.com/kuliks08/mock-api-server.git
cd mock-api-server

# 2. Configure your routes
nano api.json

# 3. Run
php -S localhost:8000 server.php
```

Your mock API is live at `http://localhost:8000` ✅

---

## ⚙️ Configuration (`api.json`)

Each entry in `api.json` defines a route: its method, path, response code, body, and optional auth.

```json
{
  "routes": [
    {
      "method": "GET",
      "path": "/users",
      "status": 200,
      "response": {
        "data": [
          { "id": 1, "name": "Aleksandr", "email": "alex@example.com" },
          { "id": 2, "name": "Ivan",      "email": "ivan@example.com" }
        ]
      }
    },
    {
      "method": "POST",
      "path": "/users",
      "status": 201,
      "auth": "Bearer token_abc123",
      "response": {
        "message": "User created",
        "id": 42
      }
    },
    {
      "method": "GET",
      "path": "/profile",
      "status": 200,
      "auth": "Bearer token_xyz789",
      "response": {
        "id": 1,
        "name": "Aleksandr Kulikov",
        "role": "admin"
      }
    },
    {
      "method": "GET",
      "path": "/report.csv",
      "status": 200,
      "file": "files/report.csv"
    },
    {
      "method": "PUT",
      "path": "/products/123",
      "status": 200,
      "response": {
        "message": "Product updated"
      }
    }
  ]
}
```

---

## 🔐 Authentication

Routes with `"auth"` set will return `401 Unauthorized` unless the request includes the matching `Authorization` header.

```bash
# ✅ Authorized request
curl -H "Authorization: Bearer token_abc123" http://localhost:8000/users

# ❌ Returns 401
curl http://localhost:8000/users
```

---

## 📝 Request Logging

Every request is logged to stdout with full detail:

```
[2026-04-30 12:34:56] POST /users
Headers: {"Content-Type":"application/json","Authorization":"Bearer ..."}
Body:    {"name":"Test User","email":"test@example.com"}
Query:   {}
→ 201 Created
```

---

## 📂 File Download Simulation

Set `"file"` instead of `"response"` to serve a real file as the response body — useful for testing CSV export, PDF download, image fetch, etc.

```json
{
  "method": "GET",
  "path": "/export/users.csv",
  "status": 200,
  "file": "files/users.csv"
}
```

---

## 🧪 Testing with Postman / curl

```bash
# GET list
curl http://localhost:8000/users

# POST with auth
curl -X POST http://localhost:8000/users \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer token_abc123" \
  -d '{"name":"New User"}'

# Download file
curl http://localhost:8000/report.csv -o report.csv
```

---

## 📋 Requirements

- PHP **7.0** or higher (built-in server)
- No Composer, no extensions required

---

## 👤 Author

**Aleksandr Kulikov** · [github.com/kuliks08](https://github.com/kuliks08)

---

## 📄 License

MIT — use freely in personal and commercial projects.
