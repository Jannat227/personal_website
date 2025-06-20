<script>
    const langBtn = document.getElementById('langBtn');
    const darkBtn = document.getElementById('darkModeBtn');
    const menu = document.querySelector('.menu');
    const menuToggle = document.getElementById('menuToggle');

    let isArabic = false;
    let isDark = false;

    menuToggle.onclick = () => {
        menu.classList.toggle('open');
    };

    langBtn.onclick = () => {
        isArabic = !isArabic;
        if (isArabic) {
            document.body.dir = "rtl";
            langBtn.textContent = "EN";
        } else {
            document.body.dir = "ltr";
            langBtn.textContent = "AR";
        }
    };

    darkBtn.onclick = () => {
        isDark = !isDark;
        document.body.classList.toggle('dark-mode', isDark);
    };
</script>
