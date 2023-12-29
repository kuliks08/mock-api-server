# Mock API Server

This project is a simple PHP-based mock API server that can be used for testing and development purposes. The server accepts HTTP requests, logs the request details, and responds based on predefined routes specified in the `api.json` configuration file.

## Features

- **Request Logging:** Logs detailed information about each incoming HTTP request, including headers, body, and query parameters.
- **Dynamic Routing:** Allows configuration of custom routes and responses via the `api.json` file.
- **Token-Based Authentication:** Supports simple token-based authentication for specific routes.
- **File Downloads:** Enables serving files as responses, useful for testing file download scenarios.

## Getting Started

1. Clone the repository to your local machine.

    ```bash
    git clone https://github.com/your-username/mock-api-server.git
    cd mock-api-server
    ```

2. Customize the `api.json` file to define your desired routes and responses.

3. Start the PHP built-in server.

    ```bash
    php -S localhost:8000
    ```

4. Send HTTP requests to `http://localhost:8000` based on your configured routes.

## Configuration (api.json)

The `api.json` file contains the configuration for the mock API server. Define your routes, response codes, and data structures in this file. See examples in the provided `api.json` file.

## Examples

- `GET /users`: Retrieve a list of users.
- `POST /users`: Create a new user (requires a token).
- `GET /profile`: Get user profile information (requires a different token).
- `GET /products`: Retrieve product information from a file.
- `PUT /products/123`: Update information for a specific product.

## Dependencies

- PHP 7.0 or higher

## Developer

This project is developed and maintained by Aleksandr Kulikov.

- GitHub: [https://github.com/kuliks08](https://github.com/kuliks08)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contributing

Feel free to contribute by opening issues or creating pull requests.

## Acknowledgments

- This project was inspired by the need for a lightweight mock API server for testing purposes.

---

## How to Use

1. **Install Dependencies**

   Make sure you have PHP installed on your machine. You can download it from [php.net](https://www.php.net/downloads.php).

2. **Clone the Repository**

   ```bash
   git clone https://github.com/kuliks08/mock-api-server.git
   cd mock-api-server
3. **Configure Routes**

    Customize the api.json file to define your API routes and responses.
4. **Run the Server**
   Start the PHP built-in server:
    ```bash
   php -S localhost:8000
5. **Send Requests**
   Use your favorite API testing tool (e.g., Postman) or make HTTP requests directly to http://localhost:8000 based on your configured routes.
## License
This project is licensed under the MIT License - see the LICENSE file for details.