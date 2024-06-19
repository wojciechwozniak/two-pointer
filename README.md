# Water Trap API

This is a PHP API based on Laravel, utilizing MariaDB and Apache. It demonstrates the operation of the two-pointer algorithm by filling free spaces with water. This project is dockerized, and the Docker container also includes Adminer for database inspection.


## Requirements

- Docker

## Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/wojciechwozniak/two-pointer
   cd two-pointer
   ```
2. Build the Docker containers:
   ```bash
   docker-compose up --build -d
   ```
3. In the project root directory, you can find a [Trap.postman_collection.json](Trap.postman_collection.json) file that you can import into Postman to test the API.

## API

### Calculate

#### Request

```http
POST /api/calculate
Content-Type: application/json

{
    "heights": [0,1,0,2,1,0,1,3,2,1,2,1]
}
```   

#### Response

```json
{
    "trapped_water": 6
}
```
## Specific Error Messages

In addition to the standard HTTP status codes, our API may return specific error messages related to the `heights` field in the request body. Here are the possible error messages:

| Error Code | Description |
|------------|-------------|
| Error 1001 | Heights field is required. |
| Error 1002 | Heights field is not an array. |
| Error 1003 | Heights field must have at least three elements. |
| Error 1004 | Each element in the Heights field must be an integer. |