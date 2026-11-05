<?php 
add_shortcode( 'informations_voyant', 'informations_voyant' );
function informations_voyant($attr)
{
     global $wpdb;

     extract(shortcode_atts(array(
       "user_id" => $_SESSION["user_id"],
       "date_debut" => '',
       "date_fin" => '',
       "limit" => '',
       "type"=>'',
       ), $attr));
           $first_name = get_user_meta($user_id, 'first_name',true);
           $last_name=get_user_meta($user_id, 'last_name',true);
           $civilite=$last_name=get_user_meta($user_id, 'civilite',true);
           $surnom=get_user_meta($user_id, 'nickname',true);
           $user_info = get_userdata($user_id);
           $email = $user_info->user_email;
           $pass=$user_info->user_pass;
           $code_personnel=get_user_meta($user_id, 'code_personnel',true);
           $date_naissance=date("d/m/Y",strtotime(get_user_meta($user_id, 'date_de_naissance',true)));
           $avatar= get_avatar( $user_id,32);
           $code_expert= get_user_meta($user_id, 'code_expert',true);
           $forfait=secondstoTime(database::forfait($user_id));
           $tel= get_user_meta($user_id, 'numero_de_tlphone',true);
           $adresse= get_user_meta($user_id, 'adresse',true);
           $complement_adresse=get_user_meta($user_id, 'complement_adresse',true);
           $code_postal= get_user_meta($user_id, 'code_postal',true);
           $ville= get_user_meta($user_id, 'ville',true);
           $pays= get_user_meta($user_id, 'pays',true);
           $statut= get_user_meta($user_id, 'statut',true);
           $nom_de_la_societe= get_user_meta($user_id, 'nom_de_la_societe',true);
           $adresse_societe= get_user_meta($user_id, 'adresse_societe',true);
           $complement_dadresse_societe= get_user_meta($user_id, 'complement_dadresse_societe',true);
           $code_postal_societe= get_user_meta($user_id, 'code_postal_societe',true);
           $ville_societe= get_user_meta($user_id, 'ville_societe',true);
           $n_tva_intracommunautaire= get_user_meta($user_id, 'n_tva_intracommunautaire',true);
           $siret= get_user_meta($user_id, 'siret',true);
           $piece_didentite_cni_passeport_= get_user_meta($user_id, 'piece_didentite_cni_passeport_',true);

           $langues_parles_couramment_= get_user_meta($user_id, 'langues_parles_couramment_',true);
           $n_tva_intracommunautaire= get_user_meta($user_id, 'n_tva_intracommunautaire',true);
           $siret= get_user_meta($user_id, 'siret',true);
           $piece_didentite_cni_passeport_= get_user_meta($user_id, 'piece_didentite_cni_passeport_',true);
           $specialites= get_user_meta($user_id, 'spcialite',true);
           $themes= get_user_meta($user_id, 'theme',true);
           $types=get_user_meta($user_id, 'vos_types_de_consultations',true);
        
           $Allemand= ( in_array( 'Allemand', (array) $langues_parles_couramment_ ) )?"checked":"";
           $Francais= ( in_array( 'Français', (array) $langues_parles_couramment_ ) )?"checked":"";
           $Anglais= ( in_array( 'Anglais', (array) $langues_parles_couramment_ ) )?"checked":"";
           $Italien= ( in_array( 'Italien', (array) $langues_parles_couramment_ ) )?"checked":"";
           $Espagnol= ( in_array( 'Espagnol', (array) $langues_parles_couramment_ ) )?"checked":"";
           $Francais_Canadien= ( in_array( 'Français Canadien', (array) $langues_parles_couramment_) )?"checked":"";

          $nom_benificiaire=get_user_meta($user_id, 'nom_et_prnom_du_bnficiaire',true);
          $iban=get_user_meta($user_id, 'iban',true);
          $nom_de_lagence_bancaire=get_user_meta($user_id, 'nom_de_lagence_bancaire',true);
          $bic=get_user_meta($user_id, 'bic',true);
           
           
$content='
<div>
<form action="" method="post" class="wpcf7-form init" enctype="multipart/form-data" novalidate="novalidate" data-status="init">
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="1027" />
<input type="hidden" name="_wpcf7_version" value="5.4" />
<input type="hidden" name="_wpcf7_locale" value="fr_FR" />
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f1027-o1" />
<input type="hidden" name="_wpcf7_container_post" value="0" />
<input type="hidden" name="_wpcf7_posted_data_hash" value="" />
</div>
<div class="bloc-form col-md-12 col-xs-12">
<div class="form-info col-md-12 col-xs-12">
<div class="title-form">
<h3>Informations générales</h3>
</div>
</div>
<div class="form-bloc col-md-10 col-xs-12 mx-auto">
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> E-mail</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
    <span class="wpcf7-form-control-wrap email-925"><input type="email" name="email-925" value="'.$email.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" /></span>
</div>
</div>

<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Mot de passe </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap password-352"><input type="password" name="password-352" value="'.$pass.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-password wpcf7-validates-as-required wpcf7-validates-as-password" password_strength="0" password_min="0" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
</div>
<div class="form-info col-md-12 col-xs-12">
<div class="title-form">
<h3>Informations personnelles</h3>
</div>
</div>
<div class="form-bloc col-md-10 col-xs-12 mx-auto">
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Civilité </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
    <span class="wpcf7-form-control-wrap menu-56">
    <select name="menu-56" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
    <option value="" >---</option>
    <option value="Mr">Mr</option>
    <option value="Mme">Mme</option>
    </select></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Prénom </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
    <span class="wpcf7-form-control-wrap prenom"><input type="text" name="prenom" value="'.$first_name.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Nom</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
    <span class="wpcf7-form-control-wrap nom"><input type="text" name="nom" value="'.$last_name.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Numéro de téléphone </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap telephone"><input type="tel" name="telephone" value="'.$tel.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Adresse </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap adresse"><input type="text" name="adresse" value="'.$adresse.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">

<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Complément d\'adresse</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap complement_adresse"><input type="text" name="complement_adresse" value="'.$complement_adresse.'" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Ville </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
  <span class="wpcf7-form-control-wrap ville"><input type="text" name="ville" value="'.$ville.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Pays </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap pays"><input type="text" name="pays" value="'.$pays.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
</div>
<div class="form-info col-md-12 col-xs-12">
<div class="title-form">
<h3>Informations professionnelles</h3>
</div>
</div>
<div class="form-bloc col-md-10 col-xs-12 mx-auto">
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Nom de la société </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
  <span class="wpcf7-form-control-wrap nom_societe"><input type="text" name="nom_societe" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Adresse société </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap adresse_societe"><input type="text" name="adresse_societe" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Complément d\'adresse société</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap complement_adresse_societe"><input type="text" name="complement_adresse_societe" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Code postal </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap code_postal_societe"><input type="number" name="code_postal_societe" value="" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-required wpcf7-validates-as-number" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Ville </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap ville_societe"><input type="text" name="ville_societe" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Statut </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap statut_societe"><input type="text" name="statut_societe" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>SIRET </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap numero_siret"><input type="number" name="numero_siret" value="" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-required wpcf7-validates-as-number" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>N° TVA Intracommunautaire </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap NTVAIntracommunautaire"><input type="number" name="NTVAIntracommunautaire" value="" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-required wpcf7-validates-as-number" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Pièce d\'identité (CNI, Passeport) </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap IMG_CNI_PASSEPORT"><input type="file" name="IMG_CNI_PASSEPORT" size="40" class="wpcf7-form-control wpcf7-file wpcf7-validates-as-required" accept=".jpg,.png,.gif" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
</div>
<div class="form-info col-md-12 col-xs-12">
<div class="title-form">
<h3>Information expert</h3>
</div>
</div>
<div class="form-bloc col-md-10 col-xs-12 mx-auto">
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Votre photo </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap photo_expert"><input type="file" name="photo_expert" size="40" class="wpcf7-form-control wpcf7-file wpcf7-validates-as-required" accept=".jpg,.png,.gif" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Pseudo professionnel </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap speudo_voyant"><input type="text" name="speudo_voyant" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Langues parlées couramment </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap Languesparlescouramment"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required"><span class="wpcf7-list-item first">
   <input type="checkbox" name="Languesparlescouramment[]" value="Français" />
   <span class="wpcf7-list-item-label">Français</span> </span><span class="wpcf7-list-item">
   <input type="checkbox" name="Languesparlescouramment[]" value="Allemand" '.$Allemand.' /><span class="wpcf7-list-item-label">Allemand</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="Languesparlescouramment[]" value="Anglais" '.$Anglais.' /><span class="wpcf7-list-item-label">Anglais</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="Languesparlescouramment[]" value="Italien" '.$Italien.'/><span class="wpcf7-list-item-label">Italien</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="Languesparlescouramment[]" value="Espagnol" '.$Espagnol.' /><span class="wpcf7-list-item-label">Espagnol</span></span><span class="wpcf7-list-item last">
   <input type="checkbox" name="Languesparlescouramment[]" value="Français Canadien" '.$Francais_Canadien.'/><span class="wpcf7-list-item-label">Français Canadien</span></span></span></span>
</div>
</div>

<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Spécialités </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">';

$Astrologie= ( in_array( 'Astrologie', (array) $specialites ) )?"checked":"";
$Numerologie= ( in_array( 'Numérologie', (array) $specialites) )?"checked":"";
$Tarologie= ( in_array( 'Tarologie', (array) $specialites) )?"checked":"";
$Voyance= ( in_array( 'Voyance', (array) $specialites ) )?"checked":"";
$Mediumnite= ( in_array( 'Médiumnité', (array) $specialites ) )?"checked":"";
$Coaching= ( in_array( 'Coaching', (array) $specialites ) )?"checked":"";
$Magnetiseur=( in_array( 'Magnétiseur', (array) $specialites ) )?"checked":"";
  $content.=' <span class="wpcf7-form-control-wrap specialite"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required"><span class="wpcf7-list-item first">
   <input type="checkbox" name="specialite[]" value="Astrologie" '.$Astrologie.' /><span class="wpcf7-list-item-label">Astrologie</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="specialite[]" value="Numérologie" '.$Numerologie.' /><span class="wpcf7-list-item-label">Numérologie</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="specialite[]" value="Tarologie" '.$Tarologie.'/><span class="wpcf7-list-item-label">Tarologie</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="specialite[]" value="Voyance" '.$Voyance.'/><span class="wpcf7-list-item-label">Voyance</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="specialite[]" value="Médiumnité" '.$Mediumnite.'/><span class="wpcf7-list-item-label">Médiumnité</span></span><span class="wpcf7-list-item last">
   <input type="checkbox" name="specialite[]" value="Autres" /><span class="wpcf7-list-item-label">Autres</span></span></span></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Thèmes </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">';
$Amour= ( in_array( 'Amours et sentiments', (array) $themes ) )?"checked":"";
$Famille= ( in_array( 'Famille et enfants', (array) $themes) )?"checked":"";
$Travail= ( in_array( 'Travail et carrière', (array) $themes) )?"checked":"";
$Bien= ( in_array( 'Bien-être et guidance', (array) $themes ) )?"checked":"";
$Finance= ( in_array( 'Finance et matériel', (array) $themes ) )?"checked":"";
$Autres= ( in_array( 'Autres', (array) $specialites ) )?"checked":"";

$content.='<span class="wpcf7-form-control-wrap Themes"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required">
<span class="wpcf7-list-item first"><input type="checkbox" name="Themes[]" value="Amours et sentiments" '.$Amour.' /><span class="wpcf7-list-item-label">Amours et sentiments</span></span>
<span class="wpcf7-list-item"><input type="checkbox" name="Themes[]" value="Famille et enfants" '.$Famille.'/><span class="wpcf7-list-item-label">Famille et enfants</span></span>
<span class="wpcf7-list-item"><input type="checkbox" name="Themes[]" value="Travail et carrière" '.$Travail.'/><span class="wpcf7-list-item-label">Travail et carrière</span></span>
<span class="wpcf7-list-item"><input type="checkbox" name="Themes[]" value="Bien-être et guidance" '.$Bien.'/><span class="wpcf7-list-item-label">Bien-être et guidance</span></span>
<span class="wpcf7-list-item"><input type="checkbox" name="Themes[]" value="Finance et matériel" '.$Finance.'/><span class="wpcf7-list-item-label">Finance et matériel</span></span>
<span class="wpcf7-list-item last"><input type="checkbox" name="Themes[]" value="Autres" '.$Autres.'/><span class="wpcf7-list-item-label">Autres</span></span></span></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Consultation par </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">';

$Tel= ( in_array( 'Téléphone', (array) $types ) )?"checked":"";
$Tchat= ( in_array( 'Tchat', (array) $types) )?"checked":"";
$Mail= ( in_array( 'Mail', (array) $types) )?"checked":"";
$Video= ( in_array( 'Vidéo', (array) $types ) )?"checked":"";
$content.=' <span class="wpcf7-form-control-wrap consultation-par"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required consultation-check">
 <span class="wpcf7-list-item first"><input type="checkbox" name="consultation-par[]" value="Téléphone" '.$Tel.'/><span class="wpcf7-list-item-label">Téléphone</span></span>
 <span class="wpcf7-list-item"><input type="checkbox" name="consultation-par[]" value="Tchat" '.$Tchat.'/><span class="wpcf7-list-item-label">Tchat</span></span>
 <span class="wpcf7-list-item"><input type="checkbox" name="consultation-par[]" value="Mail" '.$Mail.'/><span class="wpcf7-list-item-label">Mail</span></span>
 <span class="wpcf7-list-item last"><input type="checkbox" name="consultation-par[]" value="Vidéo" '.$Video.'/><span class="wpcf7-list-item-label">Vidéo</span></span>
 </span></span>
</div>
</div>


<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Êtes-vous intéressé(e) pour présenter et animer les conférences de voyance Divinicia ?</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap conference-voyance"><span class="wpcf7-form-control wpcf7-checkbox"><span class="wpcf7-list-item first"><input type="checkbox" name="conference-voyance[]" value="Oui" /><span class="wpcf7-list-item-label">Oui</span></span><span class="wpcf7-list-item last"><input type="checkbox" name="conference-voyance[]" value="Non" /><span class="wpcf7-list-item-label">Non</span></span></span></span>
</div>
</div>


</div>
<div class="form-info col-md-12 col-xs-12">
<div class="title-form">
<h3>Informations bancaires</h3>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Nom et prénom du bénéficiaire </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
  <span class="wpcf7-form-control-wrap nom_benificiaire"><input type="text" name="nom_benificiaire" value="'.$nom_benificiaire.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> IBAN </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
  <span class="wpcf7-form-control-wrap iban"><input type="text" name="iban" value="'.$iban.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Nom DE l\'agence </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
  <span class="wpcf7-form-control-wrap nom_de_lagence_bancaire"><input type="text" name="nom_de_lagence_bancaire" value="'.$nom_de_lagence_bancaire.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> BIC </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
  <span class="wpcf7-form-control-wrap bic"><input type="text" name="bic" value="'.$bic.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>


</div>


</div>
<div class="wpcf7-response-output" aria-hidden="true"></div></form></div>				
</div>'




;
return $content;
}

add_shortcode( 'demande_inscription_voyant', 'demande_inscription_voyant' );
function demande_inscription_voyant($attr)
{
     global $wpdb;

     extract(shortcode_atts(array(
       "user_id" => $_SESSION["user_id"],
       "date_debut" => '',
       "date_fin" => '',
       "limit" => '',
       "type"=>'',
       ), $attr));
           $first_name = get_user_meta($user_id, 'first_name',true);
           $last_name=get_user_meta($user_id, 'last_name',true);
           $civilite=$last_name=get_user_meta($user_id, 'civilite',true);
           $surnom=get_user_meta($user_id, 'nickname',true);
           $user_info = get_userdata($user_id);
           $email = $user_info->user_email;
           $pass=$user_info->user_pass;
           $code_personnel=get_user_meta($user_id, 'code_personnel',true);
           $date_naissance=date("d/m/Y",strtotime(get_user_meta($user_id, 'date_de_naissance',true)));
           $avatar= get_avatar( $user_id,32);
           $code_expert= get_user_meta($user_id, 'code_expert',true);
           $forfait=secondstoTime(database::forfait($user_id));
           $tel= get_user_meta($user_id, 'numero_de_tlphone',true);
           $adresse= get_user_meta($user_id, 'adresse',true);
           $complement_adresse=get_user_meta($user_id, 'complement_adresse',true);
           $code_postal= get_user_meta($user_id, 'code_postal',true);
           $ville= get_user_meta($user_id, 'ville',true);
           $pays= get_user_meta($user_id, 'pays',true);
           $statut= get_user_meta($user_id, 'statut',true);
           $nom_de_la_societe= get_user_meta($user_id, 'nom_de_la_societe',true);
           $adresse_societe= get_user_meta($user_id, 'adresse_societe',true);
           $complement_dadresse_societe= get_user_meta($user_id, 'complement_dadresse_societe',true);
           $code_postal_societe= get_user_meta($user_id, 'code_postal_societe',true);
           $ville_societe= get_user_meta($user_id, 'ville_societe',true);
           $n_tva_intracommunautaire= get_user_meta($user_id, 'n_tva_intracommunautaire',true);
           $siret= get_user_meta($user_id, 'siret',true);
           $piece_didentite_cni_passeport_= get_user_meta($user_id, 'piece_didentite_cni_passeport_',true);

           $langues_parles_couramment_= get_user_meta($user_id, 'langues_parles_couramment_',true);
           $n_tva_intracommunautaire= get_user_meta($user_id, 'n_tva_intracommunautaire',true);
           $siret= get_user_meta($user_id, 'siret',true);
           $piece_didentite_cni_passeport_= get_user_meta($user_id, 'piece_didentite_cni_passeport_',true);
           $specialites= get_user_meta($user_id, 'spcialite',true);
           $themes= get_user_meta($user_id, 'theme',true);
           $types=get_user_meta($user_id, 'vos_types_de_consultations',true);
        
           $Allemand= ( in_array( 'Allemand', (array) $langues_parles_couramment_ ) )?"checked":"";
           $Francais= ( in_array( 'Français', (array) $langues_parles_couramment_ ) )?"checked":"";
           $Anglais= ( in_array( 'Anglais', (array) $langues_parles_couramment_ ) )?"checked":"";
           $Italien= ( in_array( 'Italien', (array) $langues_parles_couramment_ ) )?"checked":"";
           $Espagnol= ( in_array( 'Espagnol', (array) $langues_parles_couramment_ ) )?"checked":"";
           $Francais_Canadien= ( in_array( 'Français Canadien', (array) $langues_parles_couramment_) )?"checked":"";

           
           
$content='
<div>
<form action="" method="post" class="wpcf7-form init" enctype="multipart/form-data" novalidate="novalidate" data-status="init">
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="1027" />
<input type="hidden" name="_wpcf7_version" value="5.4" />
<input type="hidden" name="_wpcf7_locale" value="fr_FR" />
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f1027-o1" />
<input type="hidden" name="_wpcf7_container_post" value="0" />
<input type="hidden" name="_wpcf7_posted_data_hash" value="" />
</div>
<div class="bloc-form col-md-12 col-xs-12">
<div class="form-info col-md-12 col-xs-12">
<div class="title-form">
<h3>Informations générales</h3>
</div>
</div>
<div class="form-bloc col-md-10 col-xs-12 mx-auto">
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> E-mail</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
    <span class="wpcf7-form-control-wrap email-925"><input type="email" name="email-925" value="'.$email.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" /></span>
</div>
</div>

<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Mot de passe </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap password-352"><input type="password" name="password-352" value="'.$pass.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-password wpcf7-validates-as-required wpcf7-validates-as-password" password_strength="0" password_min="0" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
</div>
<div class="form-info col-md-12 col-xs-12">
<div class="title-form">
<h3>Informations personnelles</h3>
</div>
</div>
<div class="form-bloc col-md-10 col-xs-12 mx-auto">
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Civilité </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
    <span class="wpcf7-form-control-wrap menu-56">
    <select name="menu-56" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
    <option value="" >---</option>
    <option value="Mr">Mr</option>
    <option value="Mme">Mme</option>
    </select></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Prénom </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
    <span class="wpcf7-form-control-wrap prenom"><input type="text" name="prenom" value="'.$first_name.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Nom</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
    <span class="wpcf7-form-control-wrap nom"><input type="text" name="nom" value="'.$last_name.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Numéro de téléphone </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap telephone"><input type="tel" name="telephone" value="'.$tel.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Adresse </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap adresse"><input type="text" name="adresse" value="'.$adresse.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">6

<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Complément d\'adresse</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap complement_adresse"><input type="text" name="complement_adresse" value="'.$complement_adresse.'" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Ville </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
  <span class="wpcf7-form-control-wrap ville"><input type="text" name="ville" value="'.$ville.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Pays </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap pays"><input type="text" name="pays" value="'.$pays.'" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
</div>
<div class="form-info col-md-12 col-xs-12">
<div class="title-form">
<h3>Informations professionnelles</h3>
</div>
</div>
<div class="form-bloc col-md-10 col-xs-12 mx-auto">
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Nom de la société </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
  <span class="wpcf7-form-control-wrap nom_societe"><input type="text" name="nom_societe" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Adresse société </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap adresse_societe"><input type="text" name="adresse_societe" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Complément d\'adresse société</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap complement_adresse_societe"><input type="text" name="complement_adresse_societe" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Code postal </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap code_postal_societe"><input type="number" name="code_postal_societe" value="" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-required wpcf7-validates-as-number" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Ville </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap ville_societe"><input type="text" name="ville_societe" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Statut </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap statut_societe"><input type="text" name="statut_societe" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>SIRET </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap numero_siret"><input type="number" name="numero_siret" value="" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-required wpcf7-validates-as-number" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>N° TVA Intracommunautaire </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap NTVAIntracommunautaire"><input type="number" name="NTVAIntracommunautaire" value="" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-required wpcf7-validates-as-number" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Pièce d\'identité (CNI, Passeport) </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap IMG_CNI_PASSEPORT"><input type="file" name="IMG_CNI_PASSEPORT" size="40" class="wpcf7-form-control wpcf7-file wpcf7-validates-as-required" accept=".jpg,.png,.gif" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
</div>
<div class="form-info col-md-12 col-xs-12">
<div class="title-form">
<h3>Information expert</h3>
</div>
</div>
<div class="form-bloc col-md-10 col-xs-12 mx-auto">
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Votre photo </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap photo_expert"><input type="file" name="photo_expert" size="40" class="wpcf7-form-control wpcf7-file wpcf7-validates-as-required" accept=".jpg,.png,.gif" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Pseudo professionnel </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap speudo_voyant"><input type="text" name="speudo_voyant" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Langues parlées couramment </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap Languesparlescouramment"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required"><span class="wpcf7-list-item first">
   <input type="checkbox" name="Languesparlescouramment[]" value="Français" />
   <span class="wpcf7-list-item-label">Français</span> </span><span class="wpcf7-list-item">
   <input type="checkbox" name="Languesparlescouramment[]" value="Allemand" '.$Allemand.' /><span class="wpcf7-list-item-label">Allemand</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="Languesparlescouramment[]" value="Anglais" '.$Anglais.' /><span class="wpcf7-list-item-label">Anglais</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="Languesparlescouramment[]" value="Italien" '.$Italien.'/><span class="wpcf7-list-item-label">Italien</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="Languesparlescouramment[]" value="Espagnol" '.$Espagnol.' /><span class="wpcf7-list-item-label">Espagnol</span></span><span class="wpcf7-list-item last">
   <input type="checkbox" name="Languesparlescouramment[]" value="Français Canadien" '.$Francais_Canadien.'/><span class="wpcf7-list-item-label">Français Canadien</span></span></span></span>
</div>
</div>

<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Spécialités </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">';

$Astrologie= ( in_array( 'Astrologie', (array) $specialites ) )?"checked":"";
$Numerologie= ( in_array( 'Numérologie', (array) $specialites) )?"checked":"";
$Tarologie= ( in_array( 'Tarologie', (array) $specialites) )?"checked":"";
$Voyance= ( in_array( 'Voyance', (array) $specialites ) )?"checked":"";
$Mediumnite= ( in_array( 'Médiumnité', (array) $specialites ) )?"checked":"";
$Coaching= ( in_array( 'Coaching', (array) $specialites ) )?"checked":"";
$Magnetiseur=( in_array( 'Magnétiseur', (array) $specialites ) )?"checked":"";
  $content.=' <span class="wpcf7-form-control-wrap specialite"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required"><span class="wpcf7-list-item first">
   <input type="checkbox" name="specialite[]" value="Astrologie" '.$Astrologie.' /><span class="wpcf7-list-item-label">Astrologie</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="specialite[]" value="Numérologie" '.$Numerologie.' /><span class="wpcf7-list-item-label">Numérologie</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="specialite[]" value="Tarologie" '.$Tarologie.'/><span class="wpcf7-list-item-label">Tarologie</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="specialite[]" value="Voyance" '.$Voyance.'/><span class="wpcf7-list-item-label">Voyance</span></span><span class="wpcf7-list-item">
   <input type="checkbox" name="specialite[]" value="Médiumnité" '.$Mediumnite.'/><span class="wpcf7-list-item-label">Médiumnité</span></span><span class="wpcf7-list-item last">
   <input type="checkbox" name="specialite[]" value="Autres" /><span class="wpcf7-list-item-label">Autres</span></span></span></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Thèmes </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">';
$Amour= ( in_array( 'Amours et sentiments', (array) $themes ) )?"checked":"";
$Famille= ( in_array( 'Famille et enfants', (array) $themes) )?"checked":"";
$Travail= ( in_array( 'Travail et carrière', (array) $themes) )?"checked":"";
$Bien= ( in_array( 'Bien-être et guidance', (array) $themes ) )?"checked":"";
$Finance= ( in_array( 'Finance et matériel', (array) $themes ) )?"checked":"";
$Autres= ( in_array( 'Autres', (array) $specialites ) )?"checked":"";

$content.='<span class="wpcf7-form-control-wrap Themes"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required">
<span class="wpcf7-list-item first"><input type="checkbox" name="Themes[]" value="Amours et sentiments" '.$Amour.' /><span class="wpcf7-list-item-label">Amours et sentiments</span></span>
<span class="wpcf7-list-item"><input type="checkbox" name="Themes[]" value="Famille et enfants" '.$Famille.'/><span class="wpcf7-list-item-label">Famille et enfants</span></span>
<span class="wpcf7-list-item"><input type="checkbox" name="Themes[]" value="Travail et carrière" '.$Travail.'/><span class="wpcf7-list-item-label">Travail et carrière</span></span>
<span class="wpcf7-list-item"><input type="checkbox" name="Themes[]" value="Bien-être et guidance" '.$Bien.'/><span class="wpcf7-list-item-label">Bien-être et guidance</span></span>
<span class="wpcf7-list-item"><input type="checkbox" name="Themes[]" value="Finance et matériel" '.$Finance.'/><span class="wpcf7-list-item-label">Finance et matériel</span></span>
<span class="wpcf7-list-item last"><input type="checkbox" name="Themes[]" value="Autres" '.$Autres.'/><span class="wpcf7-list-item-label">Autres</span></span></span></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label> Consultation par </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">';

$Tel= ( in_array( 'Téléphone', (array) $types ) )?"checked":"";
$Tchat= ( in_array( 'Tchat', (array) $types) )?"checked":"";
$Mail= ( in_array( 'Mail', (array) $types) )?"checked":"";
$Video= ( in_array( 'Vidéo', (array) $types ) )?"checked":"";
$content.=' <span class="wpcf7-form-control-wrap consultation-par"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required consultation-check">
 <span class="wpcf7-list-item first"><input type="checkbox" name="consultation-par[]" value="Téléphone" '.$Tel.'/><span class="wpcf7-list-item-label">Téléphone</span></span>
 <span class="wpcf7-list-item"><input type="checkbox" name="consultation-par[]" value="Tchat" '.$Tchat.'/><span class="wpcf7-list-item-label">Tchat</span></span>
 <span class="wpcf7-list-item"><input type="checkbox" name="consultation-par[]" value="Mail" '.$Mail.'/><span class="wpcf7-list-item-label">Mail</span></span>
 <span class="wpcf7-list-item last"><input type="checkbox" name="consultation-par[]" value="Vidéo" '.$Video.'/><span class="wpcf7-list-item-label">Vidéo</span></span>
 </span></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Présentation générale </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap Presentationgenerale"><textarea name="Presentationgenerale" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false"></textarea></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Votre citation de vie </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap citationdevie"><input type="text" name="citationdevie" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Votre présentation audio</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap presentation_audio"><input type="file" name="presentation_audio" size="40" class="wpcf7-form-control wpcf7-file" accept=".zip,.mp3,.wave" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Êtes-vous intéressé(e) pour présenter et animer les conférences de voyance Divinicia ?</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap conference-voyance"><span class="wpcf7-form-control wpcf7-checkbox"><span class="wpcf7-list-item first"><input type="checkbox" name="conference-voyance[]" value="Oui" /><span class="wpcf7-list-item-label">Oui</span></span><span class="wpcf7-list-item last"><input type="checkbox" name="conference-voyance[]" value="Non" /><span class="wpcf7-list-item-label">Non</span></span></span></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Numéro de téléphone fixe sur lequel recevoir les appels</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap num_fixe_appels"><input type="tel" name="num_fixe_appels" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-tel" aria-invalid="false" /></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Opérateur téléphonique</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
   <span class="wpcf7-form-control-wrap Operateurtelephonique"><input type="text" name="Operateurtelephonique" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" /></span>
</div>
</div>
</div>
<div class="form-info col-md-12 col-xs-12">
<div class="title-form">
<h3>Informations complémentaires</h3>
</div>
</div>
<div class="form-bloc col-md-10 col-xs-12 mx-auto">
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Quelle est votre histoire ?</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
<span class="wpcf7-form-control-wrap Quelleestvotrehistoire"><textarea name="Quelleestvotrehistoire" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>D\'où vous vient cette passion pour les arts divinatoires ?</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
<span class="wpcf7-form-control-wrap Douvousvientcettepassionpourlesartsdivinatoires"><textarea name="Douvousvientcettepassionpourlesartsdivinatoires" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Quel est votre parcours professionnel ?</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
<span class="wpcf7-form-control-wrap Quelestvotreparcours"><textarea name="Quelestvotreparcours" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Pourquoi voulez-vous rejoindre le cabinet Divinicia ? </label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
<span class="wpcf7-form-control-wrap Pourquoivoulez-vousrejoindrelecabinetDivinicia"><textarea name="Pourquoivoulez-vousrejoindrelecabinetDivinicia" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false"></textarea></span>
</div>
</div>
<div class="row">
<div class="form-bloc-1 col-md-6 col-xs-12">
<label>Vous pouvez joindre jusqu\'à trois documents (CV, lettre de motivation, documents, etc.) Divinicia souhaiterait en savoir plus sur vous ...</label></div>
<div class="form-bloc-2 col-md-6 col-xs-12">
<span class="wpcf7-form-control-wrap doc_supp_1"><input type="file" name="doc_supp_1" size="40" class="wpcf7-form-control wpcf7-file wpcf7-validates-as-required" accept=".jpg,.png,.pdf" aria-required="true" aria-invalid="false" /></span><br />
<span class="wpcf7-form-control-wrap doc_supp_2"><input type="file" name="doc_supp_2" size="40" class="wpcf7-form-control wpcf7-file wpcf7-validates-as-required" accept=".jpg,.png,.pdf" aria-required="true" aria-invalid="false" /></span><br />
<span class="wpcf7-form-control-wrap doc_supp_3"><input type="file" name="doc_supp_3" size="40" class="wpcf7-form-control wpcf7-file wpcf7-validates-as-required" accept=".jpg,.png,.pdf" aria-required="true" aria-invalid="false" /></span>
</div>
</div>
</div>
<p><input type="submit" value="JE SOUHAITE REJOINDRE LE LUXE DE LA VOYANCE" class="wpcf7-form-control wpcf7-submit button-devenir-expert" /></p>
<div class="wpcf7-response-output" aria-hidden="true"></div></form></div>				
</div>




</div>';
return $content;
}
add_shortcode( 'recap_voyant', 'recap_voyant' );
 function recap_voyant($attr)
 {
      global $wpdb;
 
      extract(shortcode_atts(array(
        "user_id" => $_SESSION["user_id"],
        "date_debut" => '',
        "date_fin" => '',
        "limit" => '',
        "type"=>'',
        ), $attr));
        $user_info = get_userdata($user_id);
        $date = date("d/m/Y",strtotime(get_user_meta($user_id, 'date_recrutement',true)));
    $content="<div>
    <h1>Recapitulatif Voyant</h1>
    <div class='row'><b>consultations : </b>".voyant_model::nbre_consultations($user_id)."</div>
    <div class='row'><b>Durée moyenne consultation : </b>".secondsToTime(voyant_model::duree_consultation_moyenne($user_id))."</div>
    <div class='row'><b>Favoris: </b>".voyant_model::nbre_favoris($user_id)."</div>
    <div class='row'><b>Avis : </b>".voyant_model::nbre_avis($user_id)."</div>
    <div class='row'><b>Date dernière connexion : </b>".voyant_model::date_derniere_connexion($user_id)."</div>
    <div class='row'><b>Connexions totales : </b>".voyant_model::nbre_connexions($user_id)."</div>
    <div class='row'><b>Moyenne consult. / jour connecté </b>".voyant_model::consultation_jour_moyenne($user_id)."</div>
    <div class='row'><b>Temps moyen de connexion : </b>".voyant_model::duree_connexion_moyenne($user_id)."</div>
    <div class='row'><b>Date de recrutement : </b>".$date."</div>

    
    
    </div>";
    $content.="<div>
    <div class='row'><b>Crédit expert: </b>".voyant_model::credit($user_id)."</div>
    <div class='row'><b>Statut expert : </b>".voyant_model::niveau_experience($user_id)."</div>
    <div class='row'><b>Commission : </b>".voyant_model::pourcentage1($user_id)."</div>
    </div>";
    $content.='<table>
    <tr><th></th> <th>Total</th> <th>Durée totale</th> <th>Durée moyenne</th></tr>
    <tr><td>Téléphone :</td><td>'.voyant_model::nbre_consultations($user_id,$date_debut,$date_fin,1).'</td><td>'.secondsToTime(voyant_model::duree_consultations($user_id,$date_debut,$date_fin,1)).'</td><td>'.secondsToTime(voyant_model::duree_consultation_moyenne($user_id,$date_debut,$date_fin,1)).'</td></tr>
    <tr><td>Tchat :</td><td>'.voyant_model::nbre_consultations($user_id,$date_debut,$date_fin,2).'</td><td>'.secondsToTime(voyant_model::duree_consultations($user_id,$date_debut,$date_fin,2)).'</td><td>'.secondsToTime(voyant_model::duree_consultation_moyenne($user_id,$date_debut,$date_fin,2)).'</td></tr>
    <tr><td>Mail :</td><td>'.voyant_model::nbre_consultations($user_id,$date_debut,$date_fin,3).'</td><td>'.secondsToTime(voyant_model::duree_consultations($user_id,$date_debut,$date_fin,3)).'</td><td>'.secondsToTime(voyant_model::duree_consultation_moyenne($user_id,$date_debut,$date_fin,3)).'</td></tr>
    <tr><td>Video :</td><td>'.voyant_model::nbre_consultations($user_id,$date_debut,$date_fin,4).'</td><td>'.secondsToTime(voyant_model::duree_consultations($user_id,$date_debut,$date_fin,4)).'</td><td>'.secondsToTime(voyant_model::duree_consultation_moyenne($user_id,$date_debut,$date_fin,4)).'</td></tr>
    </table>';
  
    return $content;

 }

add_shortcode( 'historique_consultation_voyant', 'historique_consultation_voyant' );
function historique_consultation_voyant($attr)
{
     global $wpdb;

     extract(shortcode_atts(array(
       "user_id" => $_SESSION["user_id"],
       "date_debut" => '',
       "date_fin" => '',
       "limit" => '',
       "type"=>'',
       ), $attr));
   $where="";
   if($date_debut&&$date_fin)
   $where.=" and consultation_date<=$date_fin and consultation_date>=$date_debut";
   if($type)
   $where.=" and consultation_type=$type ";
   if($limit)
   $limit=" limit $limit";
   
 
   $content='
   <h1>Historique des consultations</h1> 
   <table id="table"
   data-toggle="table"
   data-search="true"
   data-side-pagination="client"
   pagination= true
   data-detail-view="true"
   data-pagination="true" class="table">
   <thead>
   <tr><th data-field="date">DATE</th><th data-field="voyant">EXPERT</th><th data-field="client">CLIENT</th><th data-field="type">COMMUNICATION</th><th data-field="temps">DUREE</th><th data-visible="false" data-field="type_num"></th><th data-visible="false" data-field="consultation_id"></th><th data-field="renumeration">GAINS</th><th data-field="link">CONSULTER</th></tr> 
   </thead>
   <tbody>
   '; 
    $results = $wpdb->get_results("SELECT  * FROM `wp_consultations` where voyant_id=$user_id order by consultation_date DESC ");

   foreach ($results as $result) 
    {
           $href="#";
           $id=$result->consultation_id;
           $consultation_type;
           switch ($result->consultation_type) {
           case 1:
                   $consultation_type= "Téléphonique";
                   $href=admin_url( 'admin.php?page=consultation-tel-slug&id='.$id);
                   break;
           case 2:
                   $consultation_type= "Tchat";
                   $href=admin_url( 'admin.php?page=consultation-tchat-slug&id='.$id);
                   break;
           case 3:
                   $consultation_type= "Email";
                   $href=admin_url( 'admin.php?page=consultation-mail-slug&id='.$id);
                   break;
   }		
           $voyant_id=$result->voyant_id;
           $client_id=$result->client_id;
           $first_name = get_user_meta($voyant_id, 'first_name',true);
           $last_name=get_user_meta($voyant_id, 'last_name',true);
           $first_name_client = get_user_meta($client_id, 'first_name',true);
           $last_name_client=get_user_meta($client_id, 'last_name',true);
           $avatar= get_avatar( $client_id,32);
           $consultation_date = date('d-m-Y H:i', strtotime($result->consultation_date));
           $renumeration=wc_price($result->renumeration);
           $seconds=$result->consultation_duree;
           $output = sprintf('%02d:%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);
           $link="<div class='consult-link'><a href='$href'>></a></div>";
           $content.= "<tr>
           <td>$consultation_date</td>
           <td>$first_name $last_name</td>
           <td>$first_name_client $last_name_client</td>
           <td>$consultation_type</td>
           <td>$output</td>
           <td  style='display:none' class='consultation_type'>$result->consultation_type</td>
           <td  style='display:none' class='consultation_id'>$result->consultation_id</td>
           <td>$renumeration</td>
           <td  class='link'>$link</td>
          
           </tr>";
   
    }
   $content.='</tbody></table>';
    return $content;
   

}
