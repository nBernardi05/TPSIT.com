<script>
  addEventListener("DOMContentLoaded", text)
    function text() {
      const BIO = document.getElementById('bio');
      const BL = BIO.innerText.length;
      document.getElementById('bioform').value = BIO.innerText;
      if(BL>160){
        BIO.innerText = BIO.innerText.substring(0, 160);
      }
      if(BL<8){
        document.getElementById('bio').style.fontSize = '120px'
      }else if(BL<16){
        BIO.style.fontSize = '100px';
      }else if(BL<26){
        BIO.style.fontSize = '80px';
      }else if(BL<43){
        BIO.style.fontSize = '55px';
      }else if(BL<80){
        BIO.style.fontSize = '45px';
      }else if(BL<110){
        BIO.style.fontSize = '38px';
      }else{
        BIO.style.fontSize = '28px';
      }
    }

  </script>