# MyCompanyStatus

Welcome to MyCompanyStatus, a Laravel-based application developed for the discipline of Finance Management in the Information Management course at Lusófona University. This application is designed to provide companies with comprehensive feedback when they close their accounts at the end of the year. It offers detailed explanations and visual graphs to present the results, helping companies gain insights into their financial status.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Introduction

Managing and understanding financial status is crucial for any company's success. MyCompanyStatus aims to simplify this process by providing a user-friendly web application that analyzes financial data and generates insightful reports. By utilizing Laravel's powerful features, this application offers a seamless experience for businesses to gain a comprehensive overview of their financial performance.

## Features

- **Account Closure Analysis**: MyCompanyStatus analyzes financial data at the end of the year, providing detailed insights and explanations regarding the company's financial status.
- **Graphical Representation**: The application generates interactive graphs and charts to visually present financial data, making it easier to comprehend and interpret the results.
- **User-Friendly Interface**: MyCompanyStatus offers an intuitive and easy-to-use interface, ensuring that users can navigate the application effortlessly.
- **Secure Authentication**: The application employs Laravel's authentication system, ensuring that only authorized users can access the financial information.
- **Data Import**: MyCompanyStatus allows users to import financial data from various file formats, streamlining the process of gathering information.
- **Export Reports**: Users can export generated reports in different formats (e.g., PDF, CSV) for further analysis or presentation purposes.
- **Data Privacy**: The application prioritizes data privacy and employs best practices to safeguard sensitive financial information.

## Installation

To install and set up MyCompanyStatus, follow these steps:

1. Clone the repository to your local machine:

```shell
git clone https://github.com/diogoferreira22006678/mycompanystatus.git
```

2. Navigate to the project directory:

```shell
cd MyCompanyStatus
```

3. Install the required dependencies using Composer:

```shell
composer install
```

4. Create a new `.env` file by duplicating the `.env.example` file:

```shell
cp .env.example .env
```

5. Generate a new application key:

```shell
php artisan key:generate
```

6. Configure the database connection by updating the necessary details in the `.env` file:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mycompanystatus
DB_USERNAME=root
DB_PASSWORD=
```

7. Run the database migrations:

```shell
php artisan migrate
```

8. Start the local development server:

```shell
php artisan serve
```

9. Access MyCompanyStatus in your browser at `http://localhost:8000`.

## Usage

1. Register a new account or log in to your existing account.
2. Import your financial data in a supported file format (e.g., CSV, Excel).
3. Once the data is imported, the application will analyze and generate a detailed report.
4. Explore the generated report, which includes explanations and visual graphs representing your company's financial status.
5. Export the report in your desired format for further analysis or presentation purposes.
6. Logout from the application when you are finished.

## Contributing

We welcome contributions from anyone interested in improving MyCompanyStatus. If you would like to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix:
```shell
git checkout -b feature/your-feature
```
or
```shell
git checkout -b bugfix/your-bug-fix
```

3. Make the necessary changes and commit them:
```shell
git commit -m "Your detailed description of changes"
```

4. Push your changes to your forked repository:
```shell
git push origin feature/your-feature
```

5. Open a pull request on the original repository, describing your changes and the motivation behind them.

We appreciate your contributions and will review the pull request as soon as possible.

## License

MyCompanyStatus is released under the [MIT License](https://opensource.org/licenses/MIT). You can find the detailed terms in the [LICENSE](LICENSE) file.

---

Thank you for choosing MyCompanyStatus for your financial analysis needs. If you encounter any issues or have suggestions for improvement, please don't hesitate to reach out. Happy analyzing!
