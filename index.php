<?php
$conn = new mysqli("localhost", "root", "", "personal_website");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>by jannat</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

  <style>
    html { scroll-behavior: smooth; }
    nav ul li a.active {
      color: #fdd54d; font-weight: bold; border-bottom: 2px solid #fdd54d;
    }
    .modal {
      display: none; position: fixed; z-index: 1000; left: 0; top: 0;
      width: 100%; height: 100%; background: rgba(0,0,0,0.6);
      justify-content: center; align-items: center;
    }
    .modal.active { display: flex; }
    .modal-content {
      background: #fff; border-radius: 10px; padding: 20px; max-width: 400px; width: 90%;
      text-align: center; position: relative;
    }
    .modal-content img { max-width: 100%; border-radius: 10px; margin-bottom: 15px; }
    .modal-content h2 { margin-bottom: 10px; }
    .modal-content p { margin-bottom: 15px; color: #444; }
    .modal-content .price { font-size: 20px; color: #e91e63; font-weight: bold; }
    .close-btn {
      position: absolute; top: 10px; right: 15px; font-size: 28px; cursor: pointer; color: #888;
    }
    .close-btn:hover { color: #e91e63; }
    .executed-item, .service {
  width: 250px;
  padding: 10px;
  border-radius: 8px;
  background-color: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  margin: 10px;
  text-align: center;
  font-size: 14px;
 
}

.executed-item img, .service img {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 10px;
}

.executed-item .title, .service h4 {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 5px;
}

.executed-item .description, .service p {
  font-size: 13px;
  color: #555;
  margin-bottom: 6px;
}

.executed-item .price, .service strong {
  font-size: 14px;
  color: #e91e63;
  font-weight: bold;
}
.executed-container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.executed-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  margin-top: 20px;
}
.hidden {
  display: none;
}

nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  gap: 20px;
  align-items: center;
}

nav ul li {
  position: relative;
}

nav ul li a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
}

ul.submenu {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  background: #fff;
  border: 1px solid #ddd;
  padding: 10px 0;
  min-width: 180px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.15);
  z-index: 1000;
}

ul.submenu li {
  padding: 8px 20px;
}

ul.submenu li:hover {
  background-color: #fdd54d;
}

ul.submenu li a, ul.submenu li button, ul.submenu li select {
  color: #333;
  font-weight: normal;
}

ul.submenu li button {
  background: none;
  border: none;
  font-size: 16px;
  cursor: pointer;
}

.show-menu {
  display: block !important;
}

/* الوضع الليلي */
.dark-mode {
  background-color: #121212;
  color: #eee;
}

  </style>
  <script>
  const translations = {
    en: {
      home: "HOME",
      services: "SERVICES",
      contact: "CONTACT",
      login: "Login",
      register: "Register",
      darkMode: "🌙/☀️",
      yourWebsite: "YOUR WEBSITE<br> IS YOUR DIGITAL<br> IDENTITY",
      letsBuild: "LET'S BUILD IT TOGETHER",
      executedWorks: "OUR EXECUTED WORKS",
      ourServices: "OUR SERVICES",
      contactUs: "CONTACT US",
      sendMessage: "Send Message"
    },
    ar: {
      home: "الرئيسية",
      services: "الخدمات",
      contact: "تواصل معنا",
      login: "تسجيل الدخول",
      register: "إنشاء حساب",
      darkMode: "🌙/☀️",
      yourWebsite: "موقعك الإلكتروني<br> هو هويتك الرقمية",
      letsBuild: "لنقم ببنائه معًا",
      executedWorks: "أعمالنا المنفذة",
      ourServices: "خدماتنا",
      contactUs: "تواصل معنا",
      sendMessage: "إرسال الرسالة"
    }
  };

  function switchLanguage(lang) {
    document.getElementById("nav-home").innerHTML = translations[lang].home;
    document.getElementById("nav-services").innerHTML = translations[lang].services;
    document.getElementById("nav-contact").innerHTML = translations[lang].contact;
    document.getElementById("hero-title").innerHTML = translations[lang].yourWebsite;
    document.getElementById("hero-subtitle").innerHTML = translations[lang].letsBuild;
    document.getElementById("section-executed").innerHTML = translations[lang].executedWorks;
    document.getElementById("section-services").innerHTML = translations[lang].ourServices;
    document.getElementById("section-contact").innerHTML = translations[lang].contactUs;
    document.getElementById("send-btn").innerHTML = translations[lang].sendMessage;
    document.getElementById("login-link").innerHTML = translations[lang].login;
    document.getElementById("register-link").innerHTML = translations[lang].register;
  }
</script>

</head>

<body>
<header>
  <div class="logo">BY JANNAT</div>
  <nav>
    <ul>
      <li><a href="#executed">HOME</a></li>
      <li><a href="#services">SERVICES</a></li>
      <li><a href="#contact">CONTACT</a></li>
      <li class="menu-dropdown">
        <a href="#" onclick="toggleMenu(event)">MENU ▼</a>
        <ul class="submenu" id="menu-options">
          <li>
            <select id="language-select" onchange="switchLanguage(this.value)">
              <option value="ar">العربية</option>
              <option value="en">English</option>
            </select>
          </li>
          <li>
            <button onclick="toggleDarkMode()">🌙/☀️</button>
          </li>
          <li><a href="login_user.php">تسجيل الدخول</a></li>
          <li><a href="register.php">إنشاء حساب</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</header>


<section class="hero-image">
  <h1>YOUR WEBSITE<br> IS YOUR DIGITAL<br> IDENTITY</h1>
  <img src="hero.png" alt="Header Image" style="height: 600px; width: 600px;" />
</section>

<section class="hero"><p><br><br>LET'S BUILD IT TOGETHER<br><br><br><br></p></section>

<section class="works" id="executed">
  <h2><br><br>OUR EXECUTED WORKS<br></h2>
  <div class="executed-container">
    <div class="executed-list" id="executed-list">
      <?php
      $result = $conn->query("SELECT * FROM Images ORDER BY id DESC");
      $i = 0;
      while ($row = $result->fetch_assoc()) {
        $images = [];
        $id = $row['id'];
        $res = $conn->query("SELECT image_path FROM product_images WHERE product_id = $id");
        while ($img = $res->fetch_assoc()) $images[] = $img['image_path'];
        $hidden = $i >= 4 ? 'hidden' : '';
        echo "<div class='executed-item product $hidden' 
          data-img='" . $row['image'] . "'
          data-title='" . htmlspecialchars($row['title']) . "'
          data-desc='" . htmlspecialchars($row['description']) . "'
          data-price='" . htmlspecialchars($row['price']) . "'
          data-duration='" . htmlspecialchars($row['duration']) . "'
          data-tools='" . htmlspecialchars($row['tools']) . "'
          data-github='" . htmlspecialchars($row['github']) . "'
          data-images='" . json_encode($images) . "'>";
        echo "<img src='" . $row['image'] . "' alt='work'>";
        echo "<div class='title'>" . htmlspecialchars($row['title']) . "</div>";
        echo "<div class='description'>" . htmlspecialchars($row['description']) . "</div>";
        echo "<div class='price'>السعر: " . htmlspecialchars($row['price']) . "</div>";

        echo "</div>";
        $i++;
      }
      ?>
    </div>
    <button class="show-more-btn" onclick="showMore('executed-list')">عرض المزيد</button>
  </div>
</section>

<section class="services" id="services">
  <h2><br>OUR SERVICES<br></h2>
  <div class="services-container">
    <!-- Coding Section -->
    <div class="service-category">
      <h3>💻 WEBSITE CODING</h3>
      <div class="service-list" id="coding-list">
        <?php
        $coding = $conn->query("SELECT * FROM Images WHERE type = 'coding'");
        $i = 0;
        while ($row = $coding->fetch_assoc()) {
          $images = [];
          $id = $row['id'];
          $res = $conn->query("SELECT image_path FROM product_images WHERE product_id = $id");
          while ($img = $res->fetch_assoc()) $images[] = $img['image_path'];
          $hidden = $i >= 4 ? 'hidden' : '';
          echo "<div class='service product $hidden'
            data-title='" . htmlspecialchars($row['title']) . "'
            data-desc='" . htmlspecialchars($row['description']) . "'
            data-price='" . htmlspecialchars($row['price']) . "'
            data-duration='" . htmlspecialchars($row['duration']) . "'
            data-tools='" . htmlspecialchars($row['tools']) . "'
            data-github='" . htmlspecialchars($row['github']) . "'
            data-images='" . json_encode($images) . "'>";
          echo "<img src='" . $row['image'] . "' alt=''>";
          echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
          echo "<p>" . htmlspecialchars($row['description']) . "</p>";
          echo "<p><strong>السعر: " . htmlspecialchars($row['price']) . "</strong></p>";
          echo "</div>";
          $i++;
        }
        ?>
      </div>
      <button class="show-more-btn" onclick="showMore('coding-list')">عرض المزيد</button>
    </div>
<br><br><br>
    <!-- Design Section -->
    <div class="service-category">
      <h3>🖼️ WEBSITE DESIGN</h3>
      <div class="service-list" id="design-list">
        <?php
        $design = $conn->query("SELECT * FROM Images WHERE type = 'design'");
        $i = 0;
        while ($row = $design->fetch_assoc()) {
          $images = [];
          $id = $row['id'];
          $res = $conn->query("SELECT image_path FROM product_images WHERE product_id = $id");
          while ($img = $res->fetch_assoc()) $images[] = $img['image_path'];
          $hidden = $i >= 4 ? 'hidden' : '';
          echo "<div class='service product $hidden'
            data-title='" . htmlspecialchars($row['title']) . "'
            data-desc='" . htmlspecialchars($row['description']) . "'
            data-price='" . htmlspecialchars($row['price']) . "'
            data-duration='" . htmlspecialchars($row['duration']) . "'
            data-tools='" . htmlspecialchars($row['tools']) . "'
            data-github='" . htmlspecialchars($row['github']) . "'
            data-images='" . json_encode($images) . "'>";
          echo "<img src='" . htmlspecialchars($row['image']) . "' alt=''>";

          echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
          echo "<p>" . htmlspecialchars($row['description']) . "</p>";
          echo "<p><strong>السعر: " . htmlspecialchars($row['price']) . "</strong></p>";
          echo "</div>";
          $i++;
        }
        $conn->close();
        ?>
      </div>
      <button class="show-more-btn" onclick="showMore('design-list')">عرض المزيد</button>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal" id="product-modal">
  <div class="modal-content">
    <span class="close-btn" id="modal-close">&times;</span>
    <div id="modal-images" style="display: flex; gap: 10px; overflow-x: auto;"></div>
    <h2 id="modal-title"></h2>
    <p id="modal-desc"></p>
    <div class="price" id="modal-price"></div>
    <p id="modal-duration"></p>
    <p id="modal-tools"></p>
    <a id="modal-github" href="#" target="_blank">View on GitHub</a>
    <br><br>
    <a href="register.php">
  <button style="padding: 10px 20px; background-color: #fdd54d; border: none; font-weight: bold; border-radius: 5px;">
    اطلب الآن
  </button>
</a>

  </div>
</div>

<section class="contact" id="contact" data-aos="fade-up">
  <form class="form" action="process.php" method="POST">
    <input type="text" name="name" placeholder="What's your Name?" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" placeholder="Message" required></textarea>
    <button type="submit">Send Message</button>
  </form>
  <div class="info">
    <p>Have any question?</p>
    <h3>CONTACT US</h3>
    <p>Number phone: +964 770 000 1111</p>
    <p>E-mail: jannataltaher@gmail.com</p>
  </div>
</section>

<script>
  function showMore(id) {
    const items = document.querySelectorAll(`#${id} .hidden`);
    items.forEach(item => item.classList.remove("hidden"));
    event.target.style.display = "none";
  }

  const modal = document.getElementById('product-modal');
  const modalImages = document.getElementById('modal-images');
  const modalTitle = document.getElementById('modal-title');
  const modalDesc = document.getElementById('modal-desc');
  const modalPrice = document.getElementById('modal-price');
  const modalDuration = document.getElementById('modal-duration');
  const modalTools = document.getElementById('modal-tools');
  const modalGithub = document.getElementById('modal-github');
  const closeBtn = document.getElementById('modal-close');

  function openModal(product) {
    modalTitle.textContent = product.dataset.title;
    modalDesc.textContent = product.dataset.desc;
    modalPrice.textContent = "السعر: " + product.dataset.price;
    modalDuration.textContent = "مدة التنفيذ: " + product.dataset.duration;
    modalTools.textContent = "الأدوات المستخدمة: " + product.dataset.tools;
    modalGithub.href = product.dataset.github;

    modalImages.innerHTML = "";
    const images = JSON.parse(product.dataset.images);
    images.forEach(src => {
      const img = document.createElement('img');
      img.src = src;
      img.style.width = "100px";
      img.style.height = "80px";
      img.style.objectFit = "cover";
      img.style.borderRadius = "5px";
      modalImages.appendChild(img);
    });

    modal.classList.add('active');
  }

  document.querySelectorAll('.product').forEach(p => {
    p.addEventListener('click', () => openModal(p));
  });

  closeBtn.addEventListener('click', () => modal.classList.remove('active'));
  window.addEventListener('click', e => {
    if (e.target === modal) modal.classList.remove('active');
  });

  function orderNow() {
    alert("تم إرسال طلبك بنجاح!");
  }

  window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll("nav ul li a");
    let current = "";
    sections.forEach(section => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.clientHeight;
      if (scrollY >= sectionTop - sectionHeight / 3) {
        current = section.getAttribute("id");
      }
    });
    navLinks.forEach(link => {
      link.classList.remove("active");
      if (link.getAttribute("href") === "#" + current) {
        link.classList.add("active");
      }
    });
  });
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 1000, once: true });</script>

<script>
function toggleMenu(e) {
  e.preventDefault(); // حتى لا يفتح الرابط #
  const menu = document.getElementById("menu-options");
  menu.classList.toggle("show-menu");
}

function toggleDarkMode() {
  document.body.classList.toggle('dark-mode');
}

function switchLanguage(lang) {
  alert("تم تغيير اللغة إلى: " + (lang === 'ar' ? 'العربية' : 'الإنجليزية'));
}
</script>

</body>
</html>
