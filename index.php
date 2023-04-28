<?php
    include 'header.php';
?>
<link href="index.css" rel="stylesheet"/>
<?php
    include 'navigation.php';
?>


    <div class="item item-3">
        <br>
        <h1>Welcome to my Website!</h1>
        <p><em>ECS417U 1st Year Computer Science Web-Development Project by Mohammad Usman Khan</em></p>
        <br>

    </div>
    <section class="item item-4">
        <h1>About Me</h1>
        <p>My name is Mohammad Usman Khan. I am a 1st year Computer Science undergrad student, studying at Queen Mary University of London.</p>
        <article>
            <img id="portrait" src="images/usman.png">
            <p>Besides software and web development, I enjoy working out, gaming, creating YouTube videos.</p>
        </article>
    </section>
    <aside class="item item-5">
        <iframe title="cvframe" id="cvframe" name="cvframe" src="images/CV-2023.pdf"></iframe>
        <script type="text/javascript" src="../js/printCV.js"></script>
        <a id="downloadPDF" href="" onclick="printExternal('../images/CV-2023.pdf');">Click here to download my CV.</a> 
    </aside>
    <footer class="item item-6">
        <button class="a1" onclick="location.href='https://github.com/usmankhan-mohammad'"><img src="images/github.png" class="footerImg image-1"><p class="mobileLabel l1">GitHub</p></a>
        <button class="a1" onclick="location.href='https://youtube.com/c/usman16k'"><img src="images/youtube.png" class="footerImg image-2"><p class="mobileLabel l2">YouTube</p></a>
        <button class="a1" onclick="location.href='https://instagram.com/usmankh.an?igshid=YmMyMTA2M2Y='"><img src="images/instagram.png" class="footerImg image-3"><p class="mobileLabel l3">Instagram</p></a>
        <button class="a1" onclick="location.href='https://www.linkedin.com/in/mohammad-usman-khan-01a16b25a'"><img src="images/linkedin.png" class="footerImg image-4"><p class="mobileLabel l4">LinkedIn</p></a>
        <button class="footerImg popup" id="popup">Click Here to Learn How to Navigate</button>
        <script type="text/javascript" src="../js/navPopUp.js"></script>
    </footer>


    <div class="item item-7"></div>
    <div class="item item-8"></div>
    <div class="item item-9"></div>

</div>
</div>
</body>
</html>