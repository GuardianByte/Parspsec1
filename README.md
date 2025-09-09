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
<img width="1512" height="982" alt="Screenshot 2025-09-09 at 8 14 45 AM" src="https://github.com/user-attachments/assets/db903df8-91e7-4186-bf6a-d6b6be0307ca" />

<img width="1512" height="982" alt="Screenshot 2025-09-09 at 8 14 54 AM" src="https://github.com/user-attachments/assets/1c5152eb-a478-4be7-a306-e211007cf1c2" />



### Secured Page
- URL: `http://3.87.88.51/page2.html`  
- Test payload:  
```
' OR '1'='1
sqlmap -u "http://3.87.88.51/page2.php" --data="username=test*&password=test" --method=POST --dbms=mysql --technique=B --batch --dump
```
❌ Blocked by Mod Security WAF.
<img width="1502" height="294" alt="Screenshot 2025-09-09 at 8 29 29 AM" src="https://github.com/user-attachments/assets/0fdf8cda-6a1c-47f8-975d-641bb610cb6a" />

<img width="1505" height="651" alt="Screenshot 2025-09-09 at 8 29 33 AM" src="https://github.com/user-attachments/assets/8cca5a27-2360-4d99-aad2-49358c644484" />

<img width="1350" height="575" alt="Screenshot 2025-09-09 at 8 17 37 AM" src="https://github.com/user-attachments/assets/fa787a32-a055-4ba6-9718-ef144069ea9f" />
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

