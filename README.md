# 🔐 SecureCloud

### Cloud-Based Authentication & Access Management Platform

<p align="center">
  <b>A centralized security layer for authentication, authorization, application access and security monitoring.</b>
</p>

<p align="center">

![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.4-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![AWS Cognito](https://img.shields.io/badge/AWS%20Cognito-Authentication-FF9900?style=for-the-badge&logo=amazonaws&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Containerized-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![OAuth 2.0](https://img.shields.io/badge/OAuth-2.0-000000?style=for-the-badge)
![OIDC](https://img.shields.io/badge/OIDC-OpenID%20Connect-8A2BE2?style=for-the-badge)

</p>

---

## 📖 Project Description

**SecureCloud** is a cloud-based authentication and access management platform designed to provide a centralized security layer for applications.

Instead of every application managing authentication and authorization independently, SecureCloud provides a centralized platform for:

- User authentication
- Role-based authorization
- Application access management
- User account management
- Security event logging
- Security risk analysis
- Audit tracking

AWS Cognito is used as the identity provider, while Laravel manages application-level authorization, roles, access permissions and security monitoring.

---

# 🎯 Problem Statement

Modern organizations often operate multiple internal applications.

Managing authentication and access separately for every application can lead to:

- Duplicate authentication systems
- Inconsistent authorization rules
- Difficult user management
- Poor visibility into security events
- Difficult access auditing

SecureCloud addresses this by introducing a centralized security and access-management layer.

### Concept

```text
                ┌──────────────────────┐
                │        USER          │
                └──────────┬───────────┘
                           │
                           ▼
                ┌──────────────────────┐
                │     SECURECLOUD      │
                │ Authentication Layer │
                └──────────┬───────────┘
                           │
                           ▼
                ┌──────────────────────┐
                │     AWS COGNITO      │
                │ Identity Provider    │
                └──────────┬───────────┘
                           │
                           ▼
                ┌──────────────────────┐
                │ OAuth 2.0 + OIDC     │
                └──────────┬───────────┘
                           │
                           ▼
                ┌──────────────────────┐
                │   RBAC / Permissions │
                └──────────┬───────────┘
                           │
             ┌─────────────┴─────────────┐
             ▼                           ▼
      ┌──────────────┐           ┌──────────────┐
      │ HR Portal    │           │ Finance      │
      │              │           │ Portal       │
      └──────────────┘           └──────────────┘
