# Web Security Demo – SQL Injection & Mitigation with ModSecurity WAF

## 📌 Project Overview
This project demonstrates:
1. A vulnerable login form (`page1.html`) exploitable via SQL Injection.
2. A secure login form (`page2.php`) protected by **ModSecurity WAF**.

The goal is to showcase how SQL Injection can be exploited and then mitigated using ModSecurity.

---

## 🚀 Architecture
- **AWS EC2 (Ubuntu 22.04)**  
- **Apache2 + PHP + MySQL**  
- **ModSecurity + OWASP CRS (Core Rule Set)**  
- **Two Login Forms**  
  - `page1.html` → Vulnerable  
  - `page2.php` → Secured by ModSecurity WAF

---

## 🔍 Testing SQL Injection

### Vulnerable Page
- URL: `http://3.87.88.51/page1.html`  
- Test payload:  
```
' OR '1'='1
sqlmap -u "http://3.87.88.51/page1.php" --data="username=test*&password=test" --method=POST --dbms=mysql --technique=B --batch --dump
```
✅ Should log in (bypasses authentication).

### Secured Page
- URL: `http://3.87.88.51/page2.html`  
- Test payload:  
```
' OR '1'='1
sqlmap -u "http://3.87.88.51/page2.php" --data="username=test*&password=test" --method=POST --dbms=mysql --technique=B --batch --dump
```
❌ Blocked by ModSecurity WAF.

---

## 📂 Deliverables
- Vulnerable form: `http://3.87.88.51/page1.html`  
- Secure form: `http://3.87.88.51/page2.html`  

---

## ✅ Submission Format
- Provide IP + URLs  
- GitHub repo with:
  - `README.md` (this file)  
  - `page1.html`, `page1.php`, `page2.php`  
  - `setup.sql`  
  - `install-instructions.md`  
  - `Web_Security_Demo_Documentation.docx`  

---

## 🔒 Author Notes
This project is for **educational and security demonstration purposes only**.

