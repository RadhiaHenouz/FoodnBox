<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Tabs - Default functionality</title>
   <script>
  $(document).ready(function() {
   
    $( "#tabs" ).tabs();

 
  });
  </script>
</head>
<body>
 
<div id="tabs" class="tabs">
  <ul>
    <li id="IA"><a href="#tabs-1">Informations assuré</a></li>
    <li id="DG"><a href="#tabs-2">Documents générés</a></li>
    <li id="SC"><a href="#tabs-3">Situation comptable </a></li>
    <li id="SD"><a href="#tabs-4">Statistiques détaillées </a></li>
  </ul>
  <div id="tabs-1">

  <?php $this->load->view("InformationsAssure");?>
  </div>
  <div id="tabs-2">
  
  <div class="categorie">
  <label>
    <input type="radio" name="categorie" value="A" checked /> Attestations
  </label>
  <label>
    <input type="radio" name="categorie" value="R" /> Relances
  </label>
  <label>
    <input type="radio" name="categorie" value="T" /> Quittances  </label>
  </div>
  <br>
  <div id="div_table">
  
  </div>
     </div>
  <div id="tabs-3">
  <div id="div_table_SC">
  
  </div>
  </div>
 <div id="tabs-4">
  <div id="div_table_SDA">

  </div>
 </div>
</div>
 
 