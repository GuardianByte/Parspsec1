
# Project Title
# Web Security Demo – SQL Injection & Mitigation with ModSecurity WAF

## 📌 Project Overview
This project demonstrates:
1. A vulnerable login form (`page1.html`) exploitable via SQL Injection.
2. A secure login form (`page2.html`) protected by **ModSecurity WAF**.

The goal is to showcase how SQL Injection can be exploited and then mitigated using ModSecurity WAF.
---

## 🚀 Architecture
- **AWS EC2 (Ubuntu 22.04)**  
- **Apache2 + PHP + MySQL**  
- **ModSecurity + OWASP CRS (Core Rule Set)**  
- **Two Login Forms**  
  - `page1.html` → Vulnerable  
  - `page2.html` → Secured by ModSecurity WAF
---

## 🔍 Testing SQL Injection

### Vulnerable Page
- URL: `http://3.87.88.51/page1.html`  
- Test payload:  
```
' OR '1'='1
sqlmap -u "http://3.87.88.51/page1.php" --data="username=test*&password=test" --method=POST --dbms=mysql --technique=B --batch --dump
```
✅ SQL injection testing (bypasses authentication).

<img width="1505" height="385" alt="Screenshot 2025-09-09 at 8 28 53 AM" src="https://github.com/user-attachments/assets/085306e7-4817-49d4-8fc5-422c73035db3" />

<img width="1503" height="269" alt="Screenshot 2025-09-09 at 8 36 25 AM" src="https://github.com/user-attachments/assets/f9dcf707-45c9-4297-8a19-d59cdcef239e" />

<img width="1512" height="982" alt="Screenshot 2025-09-09 at 8 14 45 AM" src="https://github.com/user-attachments/assets/761052c4-3a01-4065-a672-75cd37b2385e" />

<img width="1512" height="982" alt="Screenshot 2025-09-09 at 8 14 54 AM" src="https://github.com/user-attachments/assets/0685bb67-7c0f-4659-9fc7-6758c493e025" />

### Secured Page
- URL: `http://3.87.88.51/page2.html`  
- Test payload:  
```
' OR '1'='1
sqlmap -u "http://3.87.88.51/page2.php" --data="username=test*&password=test" --method=POST --dbms=mysql --technique=B --batch --dump
```
**❌ Blocked by Mod Security WAF.**

<img width="1502" height="294" alt="Screenshot 2025-09-09 at 8 29 29 AM" src="https://github.com/user-attachments/assets/b4f4ed58-49cb-47a7-bcb8-d13f2fd06a11" />

<img width="1505" height="651" alt="Screenshot 2025-09-09 at 8 29 33 AM" src="https://github.com/user-attachments/assets/a89def45-76f0-4975-af79-883ad729b78f" />

<img width="1350" height="575" alt="Screenshot 2025-09-09 at 8 17 37 AM" src="https://github.com/user-attachments/assets/deb09bc3-8e77-448b-bfa4-56991782386c" />

---
## 📂 Deliverables
- Vulnerable form: `http://3.87.88.51/page1.html`  
- Secure form: `http://3.87.88.51/page2.html`  

---
## ✅ Submission Format
- Provide IP + URLs  
- GitHub repo with:
  - `README.md` (this file)  
  - `page1.html`, `page1.php`, `page2.html`, `page2.php`  
  - `setup.sql`  
  - `install-step.md`  
---

## 🔒 Author Notes
This project is for **educational and security demonstration purposes only**.

