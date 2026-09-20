# 🔐 SecureCloud

## Cloud-Based Authentication & Access Management Platform

<p align="center">
  <b>A centralized security layer for authentication, authorization, application access and security monitoring.</b>
</p>

<p align="center">

![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.4-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![AWS Cognito](https://img.shields.io/badge/AWS%20Cognito-Identity%20Provider-FF9900?style=for-the-badge&logo=amazonaws&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Containerized-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![OAuth 2.0](https://img.shields.io/badge/OAuth-2.0-000000?style=for-the-badge)
![OIDC](https://img.shields.io/badge/OIDC-OpenID%20Connect-8A2BE2?style=for-the-badge)
![Linux](https://img.shields.io/badge/Linux-Ubuntu-E95420?style=for-the-badge&logo=ubuntu&logoColor=white)

</p>

---

## 📌 Project Overview

**SecureCloud** is a cloud-based authentication and access management platform designed to provide a centralized security layer for applications.

Instead of allowing every application to independently manage authentication, authorization and access permissions, SecureCloud provides a centralized platform for:

- 🔐 User authentication
- 👥 Role-based access control
- 🏢 Application access management
- 🚫 User account blocking and activation
- 📋 Security event logging
- 🔎 Security event analysis
- 📊 Audit tracking
- 🛡️ Application-level authorization

**AWS Cognito** acts as the identity provider, while **Laravel** manages application-level authorization, roles, application permissions, account status and security monitoring.

---

# 🎯 Problem Statement

Modern organizations often operate multiple internal and business applications.

When each application manages its own authentication and authorization system, organizations can face:

- Duplicate authentication systems
- Inconsistent authorization policies
- Difficult user administration
- Poor visibility into security events
- Difficult access auditing
- Complex application permission management
- Increased security-management overhead

SecureCloud addresses this problem by introducing a centralized authentication and access-management layer.

---

# 💡 Proposed Solution

SecureCloud separates **identity authentication** from **application authorization**.

### Authentication

AWS Cognito handles:

- User identity
- Login
- OAuth 2.0 authorization
- OpenID Connect identity information
- Authentication sessions

### Authorization

SecureCloud handles:

- User roles
- Application permissions
- Account activation status
- Application access
- Security events
- Administrative controls

This separation allows SecureCloud to act as a centralized security layer for multiple applications.

---

# 🏗️ System Architecture

```text
                         ┌──────────────────────┐
                         │        USER          │
                         └──────────┬───────────┘
                                    │
                                    ▼
                         ┌──────────────────────┐
                         │     SECURECLOUD     │
                         │  Authentication UI   │
                         └──────────┬───────────┘
                                    │
                                    ▼
                         ┌──────────────────────┐
                         │     AWS COGNITO      │
                         │   Identity Provider   │
                         └──────────┬───────────┘
                                    │
                                    ▼
                         ┌──────────────────────┐
                         │   OAuth 2.0 + OIDC   │
                         │ Authorization Code   │
                         └──────────┬───────────┘
                                    │
                                    ▼
                         ┌──────────────────────┐
                         │      LARAVEL        │
                         │ Authorization Layer │
                         └──────────┬───────────┘
                                    │
                     ┌──────────────┼──────────────┐
                     │              │              │
                     ▼              ▼              ▼
              ┌────────────┐ ┌────────────┐ ┌────────────┐
              │    RBAC    │ │ Application│ │  Security  │
              │ Permissions│ │   Access   │ │   Events   │
              └──────┬─────┘ └──────┬─────┘ └──────┬─────┘
                     │              │              │
                     └──────────────┼──────────────┘
                                    ▼
                         ┌──────────────────────┐
                         │       MySQL          │
                         │   Application DB     │
                         └──────────────────────┘
🔑 Authentication Flow

SecureCloud uses the OAuth 2.0 Authorization Code Flow with OpenID Connect.

User
 │
 │ 1. Click "Sign in with AWS Cognito"
 ▼
SecureCloud
 │
 │ 2. Generate OAuth state
 ▼
AWS Cognito
 │
 │ 3. User authentication
 ▼
AWS Cognito
 │
 │ 4. Authorization Code
 ▼
SecureCloud /callback
 │
 │ 5. Exchange code for tokens
 ▼
AWS Cognito Token Endpoint
 │
 │ 6. Access Token + ID Token
 ▼
SecureCloud
 │
 │ 7. Retrieve user identity
 ▼
Laravel
 │
 │ 8. Check local user
 │
 │ 9. Check role
 │
 │ 10. Check account status
 ▼
Dashboard
Authentication technologies
OAuth 2.0
OpenID Connect
AWS Cognito
Authorization Code Grant
State parameter validation
Server-side token exchange
Session regeneration
🛡️ Security Architecture

SecureCloud implements multiple security layers.

┌────────────────────────────────────────────┐
│              AWS COGNITO                  │
│         Identity Authentication           │
└──────────────────────┬─────────────────────┘
                       │
                       ▼
┌────────────────────────────────────────────┐
│             OAuth 2.0 / OIDC              │
│        Secure Authorization Flow           │
└──────────────────────┬─────────────────────┘
                       │
                       ▼
┌────────────────────────────────────────────┐
│             Laravel Middleware             │
│          Authentication Enforcement         │
└──────────────────────┬─────────────────────┘
                       │
                       ▼
┌────────────────────────────────────────────┐
│                  RBAC                      │
│       Admin / User Authorization           │
└──────────────────────┬─────────────────────┘
                       │
                       ▼
┌────────────────────────────────────────────┐
│        Application Permissions              │
│       Grant / Revoke Access                │
└──────────────────────┬─────────────────────┘
                       │
                       ▼
┌────────────────────────────────────────────┐
│          Security Event Logging             │
│        Audit + Risk Analysis               │
└────────────────────────────────────────────┘
👥 Role-Based Access Control

SecureCloud currently supports two application roles:

Role	Capabilities
admin	User management, application management, role/access management, security monitoring
user	Access assigned applications and user-level SecureCloud features
Admin capabilities

Administrators can:

View users
View user details
Manage user roles
Block users
Unblock users
Assign applications
Revoke application access
View application assignments
View security events
Analyze security events
Manage applications
User capabilities

Regular users can:

Authenticate using AWS Cognito
Access their SecureCloud dashboard
View their profile
Access applications assigned to them
Use authorized application routes
🚫 User Account Management

Administrators can control the active status of user accounts.

                ADMIN
                  │
          ┌───────┴───────┐
          │               │
          ▼               ▼
      BLOCK USER      UNBLOCK USER
          │               │
          ▼               ▼
     is_active=0     is_active=1
          │               │
          ▼               ▼
     Access denied     Access allowed

When an administrator blocks a user:

The user's is_active status becomes false.
A security event is generated.
The user is prevented from accessing SecureCloud.
The action becomes part of the audit trail.

Administrative accounts cannot be blocked through the standard user-management interface.

🏢 Application Access Management

SecureCloud provides centralized application-level access control.

Example applications:

                    SecureCloud
                         │
              ┌──────────┴──────────┐
              │                     │
              ▼                     ▼
         HR Portal             Finance Portal
              │                     │
              └──────────┬──────────┘
                         │
                  User Permissions

An administrator can:

Create/manage applications
Assign an application to a user
Revoke application access
View assigned applications
Control access through middleware
Audit access changes

Users can only access applications assigned to them.

Direct access to an unauthorized application route is rejected.

📋 Security Event Logging

SecureCloud maintains an audit trail of important security-related actions.

Examples include:

Successful login
Logout
User blocked
User unblocked
Application access granted
Application access revoked
Security-related events

Each event can contain:

User
Event Type
Description
IP Address
User Agent
Risk Level
Timestamp

This provides visibility into application security activity.

🔎 Security Risk Analysis

SecureCloud includes a rule-based security analysis layer.

Security events are evaluated using predefined security rules to determine:

Risk level
Security interpretation
Recommended action

Example:

Security Event
      │
      ▼
Rule Evaluation
      │
      ├───────────────┐
      ▼               ▼
Low Risk          Medium Risk
      │               │
      ▼               ▼
Normal Activity   Review Activity

The current implementation uses deterministic security rules rather than an external machine-learning or LLM service.

This keeps the system:

Explainable
Predictable
Easy to audit
Independent of paid AI APIs
🗄️ Database Architecture

SecureCloud uses MySQL 8.4.

Main entities
users
  │
  ├───────────────┐
  │               │
  ▼               ▼
user_applications  security_events
  │
  ▼
applications
Users

Stores application-level user information such as:

Name
Email
Role
Account status
Password-related Laravel fields
Applications

Stores registered applications that can be assigned to users.

User Applications

Acts as the relationship between users and applications.

users
  │
  │ many-to-many
  │
  ▼
user_applications
  │
  ▼
applications
Security Events

Stores security and administrative audit events.

🐳 Docker Architecture

SecureCloud is containerized using Docker.

                  Docker Compose
                       │
          ┌────────────┴────────────┐
          │                         │
          ▼                         ▼
┌─────────────────────┐   ┌─────────────────────┐
│   SecureCloud App   │   │      MySQL 8.4      │
│                     │   │                     │
│ Laravel 13          │   │ Application DB      │
│ PHP 8.4             │   │ Persistent Volume   │
│ Apache               │   │                     │
└──────────┬──────────┘   └──────────┬──────────┘
           │                         │
           └───────────┬─────────────┘
                       │
                       ▼
              SecureCloud Network
Containers
Container	Technology	Port
securecloud_app	Laravel + PHP + Apache	8080
securecloud_db	MySQL 8.4	3307
🚀 Getting Started
Prerequisites

Install:

Ubuntu/Linux
Git
Docker
Docker Compose

AWS Cognito configuration is also required for authentication.

1. Clone the Repository
git clone https://github.com/mayank012004/SecureCloud.git
cd SecureCloud
2. Create Environment Configuration

Copy the provided example:

cp docker-compose.env.example docker-compose.env

Edit the file:

nano docker-compose.env

Configure:

MYSQL_DATABASE=cognito_lamp
MYSQL_USER=laravel_user
MYSQL_PASSWORD=your_database_password
MYSQL_ROOT_PASSWORD=your_root_password

COGNITO_DOMAIN=https://your-cognito-domain.auth.region.amazoncognito.com
COGNITO_CLIENT_ID=your_cognito_client_id
COGNITO_CLIENT_SECRET=your_cognito_client_secret
⚠️ Never commit docker-compose.env

The real environment file contains secrets and is intentionally excluded from Git.

☁️ AWS Cognito Configuration

Create/configure an AWS Cognito User Pool and application client.

SecureCloud requires:

OAuth Flow
Authorization Code Grant
Scopes
openid
email
profile
Callback URL

For the Docker configuration:

http://127.0.0.1:8080/callback
Logout URL
http://127.0.0.1:8080/login

The Cognito application client must provide the credentials configured in:

docker-compose.env
🐳 Start SecureCloud

Build and start the application:

docker compose --env-file docker-compose.env up -d --build

Check the containers:

docker compose --env-file docker-compose.env ps

Expected result:

securecloud_app   Up
securecloud_db    Up (healthy)
🌐 Open the Application

Open:

http://127.0.0.1:8080/login

The SecureCloud login page should appear.

Authentication flow:

Login
  ↓
AWS Cognito
  ↓
Authentication
  ↓
OAuth Callback
  ↓
SecureCloud
  ↓
Dashboard
🧪 Testing
Authentication Testing

Verify:

Login page loads
Cognito authentication works
OAuth callback succeeds
Dashboard loads
Profile information is displayed
Logout returns to SecureCloud login
RBAC Testing
Admin

Verify that an administrator can:

Access /users
Manage application permissions
Block/unblock users
View security events
Manage applications
User

Verify that a normal user:

Cannot access admin functionality
Can access assigned applications
Cannot access unassigned applications
Application Access Testing

Test:

User + Assigned Application
        ↓
       ALLOW

and:

User + Unassigned Application
        ↓
       DENY
Account Blocking Testing

Test:

Admin
  ↓
Block User
  ↓
is_active = false
  ↓
User authentication/access attempt
  ↓
Access denied

Then:

Admin
  ↓
Unblock User
  ↓
is_active = true
  ↓
User can access SecureCloud
🔒 Security Considerations

SecureCloud follows several security practices:

OAuth 2.0 authorization flow
OIDC identity verification
OAuth state validation
Server-side token exchange
Laravel middleware authorization
Role-based access control
Application-level authorization
Account status enforcement
Session regeneration
Rate limiting for Cognito login initiation
Input validation
Security event logging
Audit tracking
Environment-based secrets
Docker isolation
Secrets

The following files must never be committed:

.env
docker-compose.env
.env.backup

Database backups should also remain outside the repository unless intentionally sanitized.

📁 Project Structure
SecureCloud/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   │
│   └── Models/
│
├── bootstrap/
│
├── client-portal/
│   └── External application demonstration
│
├── config/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│
├── resources/
│   └── views/
│       ├── admin/
│       ├── dashboard.blade.php
│       ├── login.blade.php
│       └── profile.blade.php
│
├── routes/
│   └── web.php
│
├── storage/
│
├── tests/
│
├── Dockerfile
├── docker-compose.yml
├── docker-compose.env.example
├── composer.json
├── composer.lock
├── package.json
├── phpunit.xml
└── README.md
🔄 Application Access Flow
User Login
    │
    ▼
AWS Cognito
    │
    ▼
SecureCloud Callback
    │
    ▼
Local User Lookup
    │
    ├── Account Active?
    │       │
    │       ├── No ──► Access Denied
    │       │
    │       └── Yes
    │
    ▼
Role Verification
    │
    ▼
Application Permission Check
    │
    ├── Authorized ──► Application
    │
    └── Unauthorized ──► Access Denied
🧩 Technology Stack
Layer	Technology
Backend	Laravel 13
Language	PHP 8.4
Database	MySQL 8.4
Authentication	AWS Cognito
Protocol	OAuth 2.0
Identity	OpenID Connect
Authorization	Laravel Middleware + RBAC
Web Server	Apache
Containerization	Docker
Operating System	Ubuntu Linux
Frontend	Blade + HTML + CSS + JavaScript
Version Control	Git + GitHub
📊 Key Features
┌─────────────────────────────────────────────┐
│               SECURECLOUD                   │
├─────────────────────────────────────────────┤
│                                             │
│  🔐 AWS Cognito Authentication              │
│  🔑 OAuth 2.0 + OIDC                       │
│  👥 Role-Based Access Control               │
│  🏢 Application Access Management           │
│  🚫 User Block / Unblock                    │
│  📋 Security Event Logging                  │
│  🔎 Rule-Based Risk Analysis                │
│  📊 Audit Trail                             │
│  🗄️ MySQL Database                          │
│  🐳 Docker Containerization                 │
│  🛡️ Middleware Authorization                │
│                                             │
└─────────────────────────────────────────────┘
🔮 Future Enhancements

Potential future improvements include:

Full application-level SSO
JWT validation for integrated applications
Microservice-based architecture
API gateway integration
Redis-based session/cache management
Advanced security analytics
Machine-learning-based anomaly detection
MFA enforcement policies
Device and session management
IP reputation analysis
Email security alerts
Centralized monitoring
Prometheus/Grafana integration
CI/CD deployment pipeline
AWS ECS/EKS deployment
Infrastructure as Code using Terraform
Production HTTPS configuration
📚 Learning Objectives

This project demonstrates practical implementation of:

Cloud authentication
OAuth 2.0
OpenID Connect
Identity management
Role-based access control
Web application security
Laravel middleware
Database design
REST-oriented backend development
Docker containerization
Linux administration
AWS service integration
Security event auditing
Application authorization
👨‍💻 Author
Mayank Singh Bora

B.Tech Computer Science Engineering
UPES

Areas of Interest
Cloud Computing
DevOps
Backend Development
Cybersecurity
Authentication & Authorization
Docker
AWS
Linux
📜 Project Status

Status: Active Development

SecureCloud is an academic/portfolio implementation designed to demonstrate cloud authentication, authorization, application access management, security engineering, Docker containerization and backend development.

<p align="center">
🔐 SecureCloud

<b>Centralized Authentication • Authorization • Application Security</b>

</p> ```
