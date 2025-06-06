# TheseBM

## Table of Contents

- [Getting Started](#getting-started)
- [Importing Database in PHPMyAdmin](#importing-database-in-phpmyadmin)

---

## Getting Started

To begin development, install [XAMPP](https://www.apachefriends.org/download.html) and copy the repository to the root folder.

### Windows

```bash
git clone git@github.com:Zorbiks/TheseBM.git C:/xampp/htdocs/TheseBM
```

### GNU/Linux

```bash
git clone git@github.com:Zorbiks/TheseBM.git
```

**Note:** On GNU/Linux, ensure you change the `DocumentRoot` option in the file located at `/opt/lampp/etc/httpd.conf` to a different directory. This avoids the need for root permissions.

**Example:**

```apache
DocumentRoot "/home/user/www"
<Directory "/home/user/www">
```

---

## Importing Database in PHPMyAdmin

1. Open ```http://localhost/phpmyadmin/``` in your browser.
2. Navigate to the **Import** tab.
3. In the **File to import:** section, click **Choose File** and select the ```thesebm.sql``` file.

![](screenshot-import-database-1.jpg)

4. Scroll down to the bottom of the page and click the **Import** button.

![](screenshot-import-database-2.jpg)