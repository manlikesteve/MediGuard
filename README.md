# 🛡️ MediGuard – AI-Powered Cyber Threat Detection System for Digital Health Infrastructure

MediGuard is an AI-based cyber threat detection system designed to protect hospital networks from Denial-of-Service (DoS) and other network-level attacks.  
It combines **Laravel** for the backend, **Vue.js** for the frontend, and a **Python-based Isolation Forest model** for anomaly detection and live network analysis.

---

## 📚 Table of Contents
- [Project Overview](#project-overview)
- [System Architecture](#system-architecture)
- [Features](#features)
- [Technology Stack](#technology-stack)
- [Setup Instructions](#setup-instructions)
- [Python Environment Setup](#python-environment-setup)
- [Running the Application](#running-the-application)
- [Branching and Contribution](#branching-and-contribution)
- [Team & Credits](#team--credits)

---

## 🧠 Project Overview

Healthcare institutions rely on digital systems for patient records, diagnostics, and hospital resource management. However, these systems are increasingly targeted by **Denial-of-Service (DoS)** attacks that can cripple operations and put patient safety at risk.

**MediGuard** addresses this problem by offering:
- Real-time anomaly detection using the **Isolation Forest** algorithm.  
- An interactive **admin and analyst dashboard** for monitoring threats.  
- Integration with simulated DoS attacks for model evaluation.  
- Lightweight architecture optimized for resource-constrained hospital networks.

---

## 🏗️ System Architecture

Frontend (Vue.js) → Backend API (Laravel) → Model Server (FastAPI, Python) → MySQL Database

All services are containerized using **Docker** for consistent deployment.

---

## ⚙️ Features

| Module | Description |
|---------|--------------|
| **User Authentication** | Login, registration, and role-based access (Admin / Analyst / Monitor). |
| **Threat Detection** | Real-time DoS anomaly detection powered by Isolation Forest. |
| **Dashboard** | Visualize alerts, system health, and live network metrics. |
| **Preprocessing Engine** | Cleans and encodes raw network traffic data. |
| **Audit Logs** | Track user activity and threat analysis reports. |

---

## 🧩 Technology Stack

| Layer | Tools / Frameworks |
|-------|--------------------|
| **Frontend** | Vue.js, TailwindCSS |
| **Backend** | Laravel 11 (PHP 8.2) |
| **AI Model** | Python 3.10+, Scikit-Learn, Pandas, FastAPI |
| **Database** | MySQL |
| **DevOps** | Docker, Composer, NPM |
| **IDE** | Visual Studio Code |

---

## 🛠️ Setup Instructions

### 1️⃣ Clone the repository

```bash
git clone https://github.com/manlikesteve/MediGuard.git
cd MediGuard/backend

### 2️⃣ Install PHP & Laravel dependencies

```bash
composer install
cp .env.example.env
php artisan key:generate

### 3️⃣ Configure the database in .env

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mediguard_db
DB_USERNAME=root
DB_PASSWORD=

### Run migrations and seed default users:

```bash
php artisan migrate
php artisan db:seed

### 4️⃣ Install Node.js dependencies

```bash
npm install
npm run dev

### 🐍 Python Environment Setup

### Navigate to the project root:

```bash
cd backend/public/python

### Create a virtual environment:

```bash
python -m venv .venv

### Activate the environment:

### On Windows

```bash
.venv\Scripts\activate


### On Mac/Linux

```bash
source .venv/bin/activate


### Install dependencies:

```bash
pip install -r requirements.txt

### Preprocess datasets:

```bash
python preprocessing/preprocess.py

### 🚀 Running the Application

### Run Laravel:

```bash
php artisan serve


### The app will be available at:

```bash
http://127.0.0.1:8000


### Start the model server (if using FastAPI):

```bash
uvicorn model_server:app --reload --port 8001

### Developer: Njino Stephen Mwaura
### Supervisor: Tiberius Tabulu
### Institution: Strathmore University, Bachelor of Science in Informatics and Computer Science
### Duration: May – December 2025

### This project is developed for academic purposes under the Strathmore University CS Final Year Project guidelines.

[![Review Assignment Due Date](https://classroom.github.com/assets/deadline-readme-button-22041afd0340ce965d47ae6ef1cefeee28c7c493a6346c4f15d667ab976d596c.svg)](https://classroom.github.com/a/blswXyO9)
[![Open in Visual Studio Code](https://classroom.github.com/assets/open-in-vscode-2e0aaae1b6195c2367325f4f02e2d04e9abb55f0b24a779b69b11b9e10269abc.svg)](https://classroom.github.com/online_ide?assignment_repo_id=20098782&assignment_repo_type=AssignmentRepo)
