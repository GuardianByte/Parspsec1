<img width="1350" height="575" alt="Screenshot 2025-09-09 at 8 17 37 AM" src="https://github.com/user-attachments/assets/e14519b9-8cfd-488d-83ea-1423795a7ff3" /># Web Security Demo – SQL Injection & Mitigation with ModSecurity WAF

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
<img width="1350" height="575" alt="Screenshot 2025-09-09 at 8 17 37 AM" src="https://github.com/user-attachments/assets/fa787a32-a055-4ba6-9718-ef144069ea9f" />
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
  - `page1.html`, `page1.php`, `page2.html`, `page2.php`  
  - `setup.sql`  
  - `install-step.md`  

---

## 🔒 Author Notes
This project is for **educational and security demonstration purposes only**.

