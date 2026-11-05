<?php 
function custom_content_2296()
{
?>
<div class ="textarea"  style="display:none">

<textarea id="rightData" name="rightData"></textarea>
   <textarea  id="backData" name="backData"></textarea>
		<textarea id="topData" name="topData"></textarea>
	   <textarea  id="leftData" name="leftData"></textarea>
</div>
<div class="tabcontainer  d-inline-block">

<ul class="tabheading">

	 <li class="active" rel="tab1"><a href="javascript:return false;">Charger une image</a> </li>
	 <li rel="tab4"><a href="javascript:return false;">Gallerie popcube</a> </li>
	 <li rel="tab2"><a href="javascript:return false;">Modèles popcube</a> </li>
	 <li rel="tab3"><a href="javascript:return false;">Ajouter un texte </a> </li>
</ul>



<div class="tabbody active" id="tab1" style="display: block;width:100%;height:500px;">
<div id="editeur" >
<input type="file" id="cropperfile" />
<br /> <br/>
<div style="width:100%;height:400px;">
 <img style="display:none" src="" id="cropper-img" />
</div>


<button type="button" id="button">Valider</button>
<button type="button" id="RAZ">Réinitialiser</button>
<div id="result"></div>


</div>
</div>
<div class="tabbody" id="tab4" style="display: none;width:100%;height:auto;overfow-y:auto">
<label for ="gal_categories" >Séléctionner la catégorie:</label>
<select name="gal_categories" id="gal_categories">

<option value="22">Naissance</option>
<option value="16">Anniversaire</option>
<option value="23">Je t'aime</option>
<option value="25">Noêl</option>
<option value="24">Nouvel an</option>
<option value="21">Fête des mères</option>
<option value="19">Fête des peres</option>
<option value="17">Mariage</option>
<option value="18">Saint Valentin</option>	
</select></br>
<div class='container'>

<div id="galery-product" class="galery-product col-md-12 col-xs-12" >
<?php          
global $wpdb;
$categorie=(isset($_POST['categorie']))? $_POST['categorie']: "";
$images = $wpdb->get_results( "SELECT * FROM `wp_483966_fbv_attachment_folder` inner join  `wp_483966_posts` on `attachment_id`=`ID` where `folder_id`=22" );
$i=0;


foreach ( $images as $image ) {
echo "<div class='img galery col-md-4 col-xs-5'>";
echo "<img  id='$image->ID' onclick='change_image($image->ID)' src='".wp_get_attachment_url( $image->ID )."' class='gallery__img' alt='Image$i'/></div>";

$i++;

}


?> 
</div>     
</div>
</div>
</div>
<div class="tabbody" id="tab2" style="width:100%;height:auto;">
<div class='container'>
<div class="gallery_mod" style="width:100%;height:auto;overflow-y: auto;">
<label for ="categories" >Séléctionner la catégorie:</label>
<select name="categories" id="categories">
<option value="tout">Tout</option>
<option value="naissance">Naissance</option>
<option value="anniversaire">Anniversaire</option>
<option value="amour">Je t'aime</option>
<option value="noel">Noêl</option>
<option value="nouvel_an">Nouvel an</option>
<option value="fete_mere">Fête des mères</option>
<option value="fete_pere">Fête des peres</option>
<option value="mariage">Mariage</option>
<option value="valentin">Saint Valentin</option>	
</select></br>
<span id="nom_cube"></span>
<div class="scene" id="gal-wrapD3Cube">
<div class="cube" id="gal-D3Cube">
<div class="cube__face cube__face--top face" id="gal-top" >
</div>
<div class="cube__face cube__face--back face" id="gal-back">arrière
</div>
<div class="cube__face cube__face--right face" id="gal-right">droite
</div>
<div class="cube__face cube__face--left face" id="gal-left">gauche
</div>
<div class="cube__face cube__face--front face" id="gal-front">
<img src="https://webandrollpreprod.ovh/cartocube/wp-content/uploads/2020/08/melting-logo.png" alt="logo"/>
</div>
<div class="cube__face cube__face--bottom face" id="gal-bottom">

<img src="https://webandrollpreprod.ovh/cartocube/wp-content/uploads/2020/08/melting-logo.png" alt="logo"/>
</div>
</div>
</div>
<div class="bouton-editeur col-md-12 col-xs-12">
<button type="button" class="select" id="select">Séléctionner le modèle</button>
<button type="button"  id="precedant" class="navigate">Précédent </button>
<button type="button"  id="suivant" class="navigate">Suivant </button>
</div>
</div>
</div>


</div>
<div class="tabbody" id="tab3" style="text-align:center;display: none;width:100%;height:500px;">
<div style="font-size:18px; font-weight:bold;">Nombre de caractères restants: <span id='NbreCar'></span></div>
<div>Maximum 6 lignes</div>
<br>

<textarea style="width:255px;height:255px;text-align:center;" name="message" id="message" rows="6" cols="20"></textarea>
<br><br>

</div>
</div>


</div>


</div>
<?php
// End of content
}
function custom_content_3015()
{
?>
<div class ="textarea"  style="display:none">

<textarea id="rightData" name="rightData"></textarea>
   <textarea  id="backData" name="backData"></textarea>
		<textarea id="topData" name="topData"></textarea>
	   <textarea  id="leftData" name="leftData"></textarea>
</div>
<div class="tabcontainer  d-inline-block">

<ul class="tabheading">

	 <li class="active" rel="tab1"><a href="javascript:return false;">Charger une image</a> </li>
	 <li rel="tab4"><a href="javascript:return false;">Gallerie popcube</a> </li>
	 <li rel="tab2"><a href="javascript:return false;">Modèles popcube</a> </li>
	 <li rel="tab3"><a href="javascript:return false;">Ajouter un texte </a> </li>
</ul>



<div class="tabbody active" id="tab1" style="display: block;width:100%;height:500px;">
<div id="editeur" >
<input type="file" id="cropperfile" />
<br /> <br/>
<div style="width:100%;height:400px;">
 <img style="display:none" src="" id="cropper-img" />
</div>


<button type="button" id="button">Valider</button>
<button type="button" id="RAZ">Réinitialiser</button>
<div id="result"></div>


</div>
</div>
<div class="tabbody" id="tab4" style="display: none;width:100%;height:auto;overfow-y:auto">
<label for ="gal_categories" >Séléctionner la catégorie:</label>
<select name="gal_categories" id="gal_categories">

<option value="22">Naissance</option>
<option value="16">Anniversaire</option>
<option value="23">Je t'aime</option>
<option value="25">Noêl</option>
<option value="24">Nouvel an</option>
<option value="21">Fête des mères</option>
<option value="19">Fête des peres</option>
<option value="17">Mariage</option>
<option value="18">Saint Valentin</option>	
</select></br>
<div class='container'>

<div id="galery-product" class="galery-product col-md-12 col-xs-12" >
<?php          
global $wpdb;
$categorie=(isset($_POST['categorie']))? $_POST['categorie']: "";
$images = $wpdb->get_results( "SELECT * FROM `wp_483966_fbv_attachment_folder` inner join  `wp_483966_posts` on `attachment_id`=`ID` where `folder_id`=22" );
$i=0;


foreach ( $images as $image ) {
echo "<div class='img galery col-md-4 col-xs-5'>";
echo "<img  id='$image->ID' onclick='change_image($image->ID)' src='".wp_get_attachment_url( $image->ID )."' class='gallery__img' alt='Image$i'/></div>";

$i++;

}


?> 
</div>     
</div>
</div>
</div>
<div class="tabbody" id="tab2" style="width:100%;height:auto;">
<div class='container'>
<div class="gallery_mod" style="width:100%;height:auto;overflow-y: auto;">
<label for ="categories" >Séléctionner la catégorie:</label>
<select name="categories" id="categories">
<option value="tout">Tout</option>
<option value="naissance">Naissance</option>
<option value="anniversaire">Anniversaire</option>
<option value="amour">Je t'aime</option>
<option value="noel">Noêl</option>
<option value="nouvel_an">Nouvel an</option>
<option value="fete_mere">Fête des mères</option>
<option value="fete_pere">Fête des peres</option>
<option value="mariage">Mariage</option>
<option value="valentin">Saint Valentin</option>	
</select></br>
<span id="nom_cube"></span>
<div class="scene" id="gal-wrapD3Cube">
<div class="cube" id="gal-D3Cube">
<div class="cube__face cube__face--top face" id="gal-top" >
</div>
<div class="cube__face cube__face--back face" id="gal-back">arrière
</div>
<div class="cube__face cube__face--right face" id="gal-right">droite
</div>
<div class="cube__face cube__face--left face" id="gal-left">gauche
</div>
<div class="cube__face cube__face--front face" id="gal-front">
<img src="https://webandrollpreprod.ovh/cartocube/wp-content/uploads/2020/08/melting-logo.png" alt="logo"/>
</div>
<div class="cube__face cube__face--bottom face" id="gal-bottom">

<img src="https://webandrollpreprod.ovh/cartocube/wp-content/uploads/2020/08/melting-logo.png" alt="logo"/>
</div>
</div>
</div>
<div class="bouton-editeur col-md-12 col-xs-12">
<button type="button" class="select" id="select">Séléctionner le modèle</button>
<button type="button"  id="precedant" class="navigate">Précédent </button>
<button type="button"  id="suivant" class="navigate">Suivant </button>
</div>
</div>
</div>


</div>
<div class="tabbody" id="tab3" style="text-align:center;display: none;width:100%;height:500px;">
<div style="font-size:18px; font-weight:bold;">Nombre de caractères restants: <span id='NbreCar'></span></div>
<div>Maximum 6 lignes</div>
<br>

<textarea style="width:255px;height:255px;text-align:center;" name="message" id="message" rows="6" cols="20"></textarea>
<br><br>

</div>
</div>


</div>


</div>
<?php
// End of content
}
