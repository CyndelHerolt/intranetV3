(self.webpackChunkintranetv3=self.webpackChunkintranetv3||[]).push([[5383,3814],{9209:(e,t,r)=>{"use strict";var n=r(2396),i=(r(1058),r(6977),r(8974),r(9755));i(document).on("click",".messagerie-filtre",(function(e){e.preventDefault(),e.stopPropagation(),i(".messagerie-filtre").parent().removeClass("active"),i(this).parent().addClass("active"),i("#messages-liste").empty().load(Routing.generate("messagerie_filtre",{filtre:i(this).data("filtre")}))})),i(document).on("click","#modalPj",(function(e){e.preventDefault(),e.stopPropagation(),i("#blocPj").toggle()})),i(document).on("click",".addFile",(function(e){e.preventDefault(),e.stopPropagation();var t=parseInt(i(this).data("file"))+1,r='<div class="row" id="file'+t+'">\n            <div class="col-10">\n                <input type="file" name="pj'+t+'" id="pj'+t+'" class="form-control pjFile" placeholder="Ajouter une pièce jointe">\n            </div>\n            <div class="col-1">\n                <button class="btn btn-block btn-success-outline addFile" data-file="'+t+'"><i class="fa fa-plus-circle"></i></button>\n            </div>\n            <div class="col-1">\n                <button class="btn btn-block btn-danger-outline removeFile" data-file="'+t+'"><i class="fa\n            fa-minus-circle"></i></button>\n            </div>\n        </div>';i("#blocPj").append(r)})),i(document).on("click",".removeFile",(function(e){e.preventDefault(),e.stopPropagation();var t=i(this).data("file");i("#file"+t).remove()})),i(document).on("click","#saveDraft",(function(e){e.preventDefault(),e.stopPropagation(),i.ajax({url:Routing.generate("messagerie_draft"),data:{messageToSemestre:i("#messageToSemestre").val(),messageToGroupe:i("#messageToGroupe").val(),messageToLibreEtudiant:i("#messageToLibreEtudiant").val(),messageToLibrePersonnel:i("#messageToLibrePersonnel").val(),typeDestinataire:i("input[type=radio][name=messageDestinataireType]:checked").val(),copie:i("#messageCopy").val(),message:i(".ql-editor").html(),sujet:i("#messageSubject").val()},method:"POST",success:function(e){i("#messages-liste").empty().load(Routing.generate("messagerie_filtre",{filtre:"draft"}))}})})),i(document).on("click",".message-read",(function(e){e.preventDefault(),e.stopPropagation(),i("#messages-liste").empty().load(Routing.generate("messagerie_message",{message:i(this).data("message")}))})),i(document).on("click",".message-read-auteur",(function(e){e.preventDefault(),e.stopPropagation(),i("#messages-liste").empty().load(Routing.generate("messagerie_message_envoye",{message:i(this).data("message")}))})),i(document).on("click","#new-message",(function(e){e.preventDefault(),e.stopPropagation(),i("#messages-liste").empty().load(Routing.generate("messagerie_nouveau"),{},(function(){console.log("new"),tinymce.remove("#messageMessage"),tinymce.init({selector:"#messageMessage",height:300,menubar:!1,language:"fr_FR",content_css:"default",toolbar:"undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent"})}))})),i(document).on("change",".pjFile",(function(){var e=0;i('input[type="file"]').each((function(t,r){void 0!==r.files[0]&&(e+=r.files[0].size)})),e/=1024,e/=1024,i("#poidPj").show().html("Le poids des pièces jointes est de "+e.toFixed(3)+" Mo")})),i(document).on("click","#messageSent",(function(e){e.preventDefault(),e.stopPropagation(),i(this).attr("disabled",!0),i(this).text("Envoi en cours...");var t=new FormData(i("form")[0]);t.append("messageMessage",tinymce.activeEditor.getContent({format:"html"})),i.ajax({url:Routing.generate("messagerie_sent"),data:t,async:!1,cache:!1,contentType:!1,enctype:"multipart/form-data",processData:!1,method:"POST",success:function(e){i("#messages-liste").empty().load(Routing.generate("messagerie_message_envoye",{message:e.message})),i("#messageSent").attr("disabled",!1),i(this).text("Envoyer")}})})),i(document).on("click",".send_draft",(function(e){e.preventDefault(),e.stopPropagation(),i("#messages-liste").empty().load(Routing.generate("messagerie_nouveau",{message:i(this).data("message")}))})),i(document).on("click",".starred",(function(){i.ajax({url:Routing.generate("messagerie_change_etat"),method:"POST",data:{valeur:"S",message:i(this).data("message")},error:function(){i(this).prop("checked",!1)}})})),i(document).on("click","#deleteMessage",(function(){i.ajax({url:Routing.generate("messagerie_change_etat"),method:"POST",data:{etat:"D",message:i(this).data("message")},success:function(){i("#messages-liste").empty().load(Routing.generate("messagerie_filtre",{filtre:"all"}))}})})),i(document).on("click",".messageDestinataireType",(function(){var e=i(this).val(),t=i("#blocDestLibreEtudiant"),r=i("#blocDestLibrePersonnel"),n=i("#blocDestMessgaeInfo"),a=i("#blocDestGroupe"),o=i("#blocDestSemestre");"e"===e?(t.show(),r.hide(),n.hide(),a.hide(),o.hide()):"s"===e?(t.hide(),r.hide(),n.hide(),a.hide(),o.show()):"g"===e?(t.hide(),r.hide(),n.hide(),a.show(),o.hide()):"p"===e&&(t.hide(),r.show(),n.hide(),a.hide(),o.hide())}));var a=r(9755),o=r(9755);a(document).on("click",".changeapplication",(function(e){e.preventDefault(),e.stopPropagation(),a(".changeapplication").removeClass("active show"),a(this).addClass("active show"),a("#mainContent").empty().load(a(this).attr("href"))})),a(document).on("change","#selectsemestre",(function(){a("#listegroupe").empty();var e=a("#selectmatiere"),t=a("#selectgroupes");a.ajax({url:Routing.generate("api_matieres_semestre",{semestre:a(this).val()}),dataType:"json",success:function(t){e.empty(),e.append(a("<option></option>").attr("value","").text("Choisir une matière")),o.each(t,(function(t,r){e.append(a("<option></option>").attr("value",r.typeMatiere+"_"+r.id).text(r.display))})),console.log(e)},error:function(){(0,n.qX)("Erreur lors de la tentative d'affichage des matières du semestres. Veuillez contacter le responsable de l'intranet si le problème persiste !","danger")}}),a.ajax({url:Routing.generate("api_type_groupe_semestre",{semestre:a(this).val()}),dataType:"json",success:function(e){t.empty(),t.append(a("<option></option>").attr("value","").text("Choisir un type de groupe")),o.each(e,(function(e,r){t.append(a("<option></option>").attr("value",r.id).text(r.libelle))}))},error:function(){(0,n.qX)("Erreur lors de la tentative d'affichage des groupes du semestres. Veuillez contacter le responsable de l'intranet si le problème persiste !","danger")}})})),a(document).on("change","#selectgroupes",(function(){var e=a("#listegroupe");a.ajax({url:Routing.generate("api_groupe_type_groupe",{typeGroupe:a(this).val()}),dataType:"json",success:function(t){e.empty();var r="";o.each(t,(function(e,t){r+='<input type="checkbox" checked name="detail_groupes[]" value="'+t.id+'"> '+t.libelle+" | "})),e.html(r)},error:function(){(0,n.qX)("Erreur lors de la tentative d'affichage des groupes du semestres. Veuillez contacter le responsable de l'intranet si le problème persiste !","danger")}})})),a(document).on("click","#add_rattrapage",(function(){a("#bloc_add_rattrapage").toggle()})),a(document).on("click","#add_carnet",(function(){a("#bloc_add_carnet").toggle()}))},8974:(e,t,r)=>{"use strict";var n=r(5594),i=r.n(n);r(4050),r(5183),r(6073),r(7189);window.addEventListener("load",(function(){document.getElementsByClassName("tinyMce").length>0&&i().init({selector:".tinyMce",height:300,menubar:!1,plugins:"lists",entity_encoding:"raw",encoding:"UTF-8",language:"fr_FR",content_css:"default",toolbar:"undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat"})}))},2396:(e,t,r)=>{"use strict";r.d(t,{qX:()=>y,FX:()=>x,xQ:()=>P,bV:()=>b,XQ:()=>T,zl:()=>R});r(4916),r(3123),r(3843),r(3710),r(3210),r(5306),r(9653);var n=r(6455),i=r.n(n),a=(r(9070),r(7941),r(2526),r(7327),r(5003),r(9554),r(4747),r(9337),r(3321),r(8588)),o=r.n(a);function s(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function l(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?s(Object(r),!0).forEach((function(t){c(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):s(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function u(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}function c(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}const d=new(function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),c(this,"defaultOptions",{close:!0,duration:3e3,className:"toast",escapeMarkup:!1,gravity:"top",position:"right",stopOnFocus:!0})}var t,r,n;return t=e,(r=[{key:"show",value:function(e,t){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null,n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{};(n=l(l({},this.defaultOptions),n)).className+=" toast-"+e;var i='<div class="toast-wrapper">';r&&(i+='<div class="toast-head">'+r+"</div>"),i+='<div class="toast-body">'+t+"</div>",i+="</div>",n.text=i,o()(n).showToast()}},{key:"error",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};this.show("error",e,t,r)}},{key:"warning",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};this.show("warning",e,t,r)}},{key:"success",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};this.show("success",e,t,r)}},{key:"info",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};this.show("info",e,t,r)}}])&&u(t.prototype,r),n&&u(t,n),e}());var m,p,g,f=r(9755),h=r(9755),v=!1;function b(e,t){for(t=t.toLowerCase();e&&e.nodeName.toLowerCase()!=t;)e=e.parentNode;return e||null}function y(e,t){switch(t){case"success":d.success(e);break;case"danger":d.error(e);break;case"warning":d.warning(e);break;case"info":d.info(e)}}m=f(location).attr("pathname"),p=m.split("/"),g=2,"index.php"===p[1]&&p.length>1&&(g=3),"super-administration"===p[g]&&(g+=1),""===p[p.length-1]&&p.pop(),f(".menu-item").removeClass("active"),f("#menu-"+p[g]).addClass("active"),i().mixin({customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),f(document).on("click",".supprimer",(function(e){e.preventDefault();var t=f(this).attr("href"),r=f(this).data("csrf");i().fire({title:"Confirmer la suppression ?",text:"L'opération ne pourra pas être annulée.",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Oui, je confirme",cancelButtonText:"Non, Annuler",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}).then((function(n){n.value?f.ajax({url:t,type:"DELETE",data:{_token:r},success:function(t){if(t.hasOwnProperty("redirect")&&t.hasOwnProperty("url"))document.location.href=t.url;else{var r=b(e.target,"tr");r.parentNode.removeChild(r),y("Suppression effectuée avec succès","success"),i().fire({title:"Supprimé!",text:"L'enregistrement a été supprimé.",icon:"success",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1})}},error:function(e,t,r){i().fire({title:"Erreur lors de la suppression!",text:"Merci de renouveler l'opération",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),y("Erreur lors de la tentative de suppression","danger")}}):"cancel"===n.dismiss&&i().fire({title:"Cancelled",text:"OK! Tout est comme avant !",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1})}))}));var C="",w="text",k=!1;function S(e){var t=f("#myedit-input-"+e).val();f.ajax({url:C.attr("href"),data:{field:C.data("field"),value:t,type:w},method:"POST",success:function(){C.html(t),f("#myEdit-zone-"+e).replaceWith(C),k=!1}})}function P(e,t){var r={};return f.each(f(e).data(),(function(e,n){if("provide"!=(e=e.replace(/-([a-z])/g,(function(e){return e[1].toUpperCase()})))){if(null!=t)switch(t[e]){case"bool":n=Boolean(n);break;case"num":n=Number(n);break;case"array":n=n.split(",")}r[e]=n}})),r}function T(e){e.removeClass("is-valid").addClass("is-invalid")}function R(e){e.removeClass("is-invalid").addClass("is-valid")}function x(e){e.removeClass("is-invalid").removeClass("is-valid")}f(document).on("click",".myedit",(function(e){e.preventDefault(),C=f(this);var t,r,n="";k=!0,void 0!==f(this).data("type")&&(w=f(this).data("type")),"select"===f(this).data("type")||("textarea"===f(this).data("type")?(t=f(this),r=Date.now(),v=!0,n='<div id="myEdit-zone-'+r+'">\n                      <textarea rows="5" class="form-control" id="myedit-input-'+r+'">'+t.html().trim()+'</textarea>\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide" data-key="'+r+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+r+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'):n=function(e){var t=Date.now();return'<div id="myEdit-zone-'+t+'" class="input-group">\n                      <input type="text" class="form-control" id="myedit-input-'+t+'" value="'+e.html().trim()+'" >\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide"  data-key="'+t+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+t+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'}(f(this))),f(this).replaceWith(n),f("#myedit-input").focus()})),f(document).on("keyup","#myedit-input",(function(e){13===e.keyCode&&!1===v?S():27===e.keyCode&&f("#myEdit-zone").replaceWith(C)})),f(document).on("click",".myedit-valide",(function(e){v=!1,e.preventDefault(),S(f(this).data("key"))})),f(document).on("keypress",(function(e){!0===k&&!1===v&&13===e.which&&(e.preventDefault(),S(f(this).data("key"))),!0===k&&!1===v&&27===e.which&&(e.preventDefault(),f("#myEdit-zone-"+f(this).data("key")).replaceWith(C))})),f(document).on("click",".myedit-annule",(function(e){e.preventDefault(),f("#myEdit-zone-"+f(this).data("key")).replaceWith(C)})),h.fn.dataAttr=function(e,t){return f(this)[0].getAttribute("data-"+e)||t},h.fn.hasDataAttr=function(e){return f(this)[0].hasAttribute("data-"+e)}},7189:()=>{tinymce.addI18n("fr_FR",{Redo:"Rétablir",Undo:"Annuler",Cut:"Couper",Copy:"Copier",Paste:"Coller","Select all":"Sélectionner tout","New document":"Nouveau document",Ok:"OK",Cancel:"Annuler","Visual aids":"Aides visuelles",Bold:"Gras",Italic:"Italique",Underline:"Souligné",Strikethrough:"Barré",Superscript:"Exposant",Subscript:"Indice","Clear formatting":"Effacer la mise en forme","Align left":"Aligner à gauche","Align center":"Centrer","Align right":"Aligner à droite",Justify:"Justifier","Bullet list":"Liste à puces","Numbered list":"Liste numérotée","Decrease indent":"Réduire le retrait","Increase indent":"Augmenter le retrait",Close:"Fermer",Formats:"Formats","Your browser doesn't support direct access to the clipboard. Please use the Ctrl+X/C/V keyboard shortcuts instead.":"Votre navigateur ne supporte pas l’accès direct au presse-papiers. Merci d'utiliser les raccourcis clavier Ctrl+X/C/V.",Headers:"En-têtes","Header 1":"En-tête 1","Header 2":"En-tête 2","Header 3":"En-tête 3","Header 4":"En-tête 4","Header 5":"En-tête 5","Header 6":"En-tête 6",Headings:"Titres","Heading 1":"Titre 1","Heading 2":"Titre 2","Heading 3":"Titre 3","Heading 4":"Titre 4","Heading 5":"Titre 5","Heading 6":"Titre 6",Preformatted:"Préformaté",Div:"Div",Pre:"Pre",Code:"Code",Paragraph:"Paragraphe",Blockquote:"Blockquote",Inline:"En ligne",Blocks:"Blocs","Paste is now in plain text mode. Contents will now be pasted as plain text until you toggle this option off.":'Le presse-papiers est maintenant en mode "texte plein". Les contenus seront collés sans retenir les formatages jusqu\'à ce que vous désactiviez cette option.',Fonts:"Polices","Font Sizes":"Tailles de police",Class:"Classe","Browse for an image":"Rechercher une image",OR:"OU","Drop an image here":"Déposer une image ici",Upload:"Télécharger",Block:"Bloc",Align:"Aligner",Default:"Par défaut",Circle:"Cercle",Disc:"Disque",Square:"Carré","Lower Alpha":"Alpha minuscule","Lower Greek":"Grec minuscule","Lower Roman":"Romain minuscule","Upper Alpha":"Alpha majuscule","Upper Roman":"Romain majuscule","Anchor...":"Ancre...",Name:"Nom",Id:"Id","Id should start with a letter, followed only by letters, numbers, dashes, dots, colons or underscores.":"L'Id doit commencer par une lettre suivi par des lettres, nombres, tirets, points, deux-points ou underscores","You have unsaved changes are you sure you want to navigate away?":"Vous avez des modifications non enregistrées, êtes-vous sûr de quitter la page?","Restore last draft":"Restaurer le dernier brouillon","Special character...":"Caractère spécial...","Source code":"Code source","Insert/Edit code sample":"Insérer / modifier une exemple de code",Language:"Langue","Code sample...":"Exemple de code...","Color Picker":"Sélecteur de couleurs",R:"R",G:"V",B:"B","Left to right":"Gauche à droite","Right to left":"Droite à gauche","Emoticons...":"Émoticônes...","Metadata and Document Properties":"Métadonnées et propriétés du document",Title:"Titre",Keywords:"Mots-clés",Description:"Description",Robots:"Robots",Author:"Auteur",Encoding:"Encodage",Fullscreen:"Plein écran",Action:"Action",Shortcut:"Raccourci",Help:"Aide",Address:"Adresse","Focus to menubar":"Cibler la barre de menu","Focus to toolbar":"Cibler la barre d'outils","Focus to element path":"Cibler le chemin vers l'élément","Focus to contextual toolbar":"Cibler la barre d'outils contextuelle","Insert link (if link plugin activated)":"Insérer un lien (si le module link est activé)","Save (if save plugin activated)":"Enregistrer (si le module save est activé)","Find (if searchreplace plugin activated)":"Rechercher (si le module searchreplace est activé)","Plugins installed ({0}):":"Modules installés ({0}) : ","Premium plugins:":"Modules premium :","Learn more...":"En savoir plus...","You are using {0}":"Vous utilisez {0}",Plugins:"Plugins","Handy Shortcuts":"Raccourcis utiles","Horizontal line":"Ligne horizontale","Insert/edit image":"Insérer/modifier une image","Image description":"Description de l'image",Source:"Source",Dimensions:"Dimensions","Constrain proportions":"Conserver les proportions",General:"Général",Advanced:"Avancé",Style:"Style","Vertical space":"Espacement vertical","Horizontal space":"Espacement horizontal",Border:"Bordure","Insert image":"Insérer une image","Image...":"Image...","Image list":"Liste d'images","Rotate counterclockwise":"Rotation anti-horaire","Rotate clockwise":"Rotation horaire","Flip vertically":"Retournement vertical","Flip horizontally":"Retournement horizontal","Edit image":"Modifier l'image","Image options":"Options de l'image","Zoom in":"Zoomer","Zoom out":"Dézoomer",Crop:"Rogner",Resize:"Redimensionner",Orientation:"Orientation",Brightness:"Luminosité",Sharpen:"Affiner",Contrast:"Contraste","Color levels":"Niveaux de couleur",Gamma:"Gamma",Invert:"Inverser",Apply:"Appliquer",Back:"Retour","Insert date/time":"Insérer date/heure","Date/time":"Date/heure","Insert/Edit Link":"Insérer/Modifier lien","Insert/edit link":"Insérer/modifier un lien","Text to display":"Texte à afficher",Url:"Url","Open link in...":"Ouvrir le lien dans...","Current window":"Fenêtre active",None:"n/a","New window":"Nouvelle fenêtre","Remove link":"Enlever le lien",Anchors:"Ancres","Link...":"Lien...","Paste or type a link":"Coller ou taper un lien","The URL you entered seems to be an email address. Do you want to add the required mailto: prefix?":"L'URL que vous avez entrée semble être une adresse e-mail. Voulez-vous ajouter le préfixe mailto: nécessaire?","The URL you entered seems to be an external link. Do you want to add the required http:// prefix?":"L'URL que vous avez entrée semble être un lien externe. Voulez-vous ajouter le préfixe http:// nécessaire?","Link list":"Liste de liens","Insert video":"Insérer une vidéo","Insert/edit video":"Insérer/modifier une vidéo","Insert/edit media":"Insérer/modifier un média","Alternative source":"Source alternative","Alternative source URL":"URL de la source alternative","Media poster (Image URL)":"Affiche de média (URL de l'image)","Paste your embed code below:":"Collez votre code d'intégration ci-dessous :",Embed:"Intégrer","Media...":"Média...","Nonbreaking space":"Espace insécable","Page break":"Saut de page","Paste as text":"Coller comme texte",Preview:"Prévisualiser","Print...":"Imprimer...",Save:"Enregistrer",Find:"Chercher","Replace with":"Remplacer par",Replace:"Remplacer","Replace all":"Tout remplacer",Previous:"Précédente",Next:"Suiv","Find and replace...":"Trouver et remplacer...","Could not find the specified string.":"Impossible de trouver la chaîne spécifiée.","Match case":"Respecter la casse","Find whole words only":"Mot entier","Spell check":"Vérification de l'orthographe",Ignore:"Ignorer","Ignore all":"Tout ignorer",Finish:"Finie","Add to Dictionary":"Ajouter au dictionnaire","Insert table":"Insérer un tableau","Table properties":"Propriétés du tableau","Delete table":"Supprimer le tableau",Cell:"Cellule",Row:"Ligne",Column:"Colonne","Cell properties":"Propriétés de la cellule","Merge cells":"Fusionner les cellules","Split cell":"Diviser la cellule","Insert row before":"Insérer une ligne avant","Insert row after":"Insérer une ligne après","Delete row":"Effacer la ligne","Row properties":"Propriétés de la ligne","Cut row":"Couper la ligne","Copy row":"Copier la ligne","Paste row before":"Coller la ligne avant","Paste row after":"Coller la ligne après","Insert column before":"Insérer une colonne avant","Insert column after":"Insérer une colonne après","Delete column":"Effacer la colonne",Cols:"Colonnes",Rows:"Lignes",Width:"Largeur",Height:"Hauteur","Cell spacing":"Espacement inter-cellulles","Cell padding":"Espacement interne cellule","Show caption":"Afficher le sous-titrage",Left:"Gauche",Center:"Centré",Right:"Droite","Cell type":"Type de cellule",Scope:"Etendue",Alignment:"Alignement","H Align":"Alignement H","V Align":"Alignement V",Top:"Haut",Middle:"Milieu",Bottom:"Bas","Header cell":"Cellule d'en-tête","Row group":"Groupe de lignes","Column group":"Groupe de colonnes","Row type":"Type de ligne",Header:"En-tête",Body:"Corps",Footer:"Pied","Border color":"Couleur de la bordure","Insert template...":"Insérer un modèle...",Templates:"Thèmes",Template:"Modèle","Text color":"Couleur du texte","Background color":"Couleur d'arrière-plan","Custom...":"Personnalisé...","Custom color":"Couleur personnalisée","No color":"Aucune couleur","Remove color":"Supprimer la couleur","Table of Contents":"Table des matières","Show blocks":"Afficher les blocs","Show invisible characters":"Afficher les caractères invisibles","Word count":"Nombre de mots",Count:"Total",Document:"Document",Selection:"Sélection",Words:"Mots","Words: {0}":"Mots : {0}","{0} words":"{0} mots",File:"Fichier",Edit:"Editer",Insert:"Insérer",View:"Voir",Format:"Format",Table:"Tableau",Tools:"Outils","Powered by {0}":"Propulsé par {0}","Rich Text Area. Press ALT-F9 for menu. Press ALT-F10 for toolbar. Press ALT-0 for help":"Zone Texte Riche. Appuyer sur ALT-F9 pour le menu. Appuyer sur ALT-F10 pour la barre d'outils. Appuyer sur ALT-0 pour de l'aide.","Image title":"Titre d'image","Border width":"Épaisseur de la bordure","Border style":"Style de la bordure",Error:"Erreur",Warn:"Avertir",Valid:"Valide","To open the popup, press Shift+Enter":"Pour ouvrir la popup, appuyez sur Maj+Entrée","Rich Text Area. Press ALT-0 for help.":"Zone de texte riche. Appuyez sur ALT-0 pour l'aide.","System Font":"Police système","Failed to upload image: {0}":"Échec d'envoi de l'image : {0}","Failed to load plugin: {0} from url {1}":"Échec de chargement du plug-in : {0} à partir de l’URL {1}","Failed to load plugin url: {0}":"Échec de chargement de l'URL du plug-in : {0}","Failed to initialize plugin: {0}":"Échec d'initialisation du plug-in : {0}",example:"exemple",Search:"Rechercher",All:"Tout",Currency:"Devise",Text:"Texte",Quotations:"Citations",Mathematical:"Opérateurs mathématiques","Extended Latin":"Latin étendu",Symbols:"Symboles",Arrows:"Flèches","User Defined":"Défini par l'utilisateur","dollar sign":"Symbole dollar","currency sign":"Symbole devise","euro-currency sign":"Symbole euro","colon sign":"Symbole colón","cruzeiro sign":"Symbole cruzeiro","french franc sign":"Symbole franc français","lira sign":"Symbole lire","mill sign":"Symbole millième","naira sign":"Symbole naira","peseta sign":"Symbole peseta","rupee sign":"Symbole roupie","won sign":"Symbole won","new sheqel sign":"Symbole nouveau chékel","dong sign":"Symbole dong","kip sign":"Symbole kip","tugrik sign":"Symbole tougrik","drachma sign":"Symbole drachme","german penny symbol":"Symbole pfennig","peso sign":"Symbole peso","guarani sign":"Symbole guarani","austral sign":"Symbole austral","hryvnia sign":"Symbole hryvnia","cedi sign":"Symbole cedi","livre tournois sign":"Symbole livre tournois","spesmilo sign":"Symbole spesmilo","tenge sign":"Symbole tenge","indian rupee sign":"Symbole roupie indienne","turkish lira sign":"Symbole lire turque","nordic mark sign":"Symbole du mark nordique","manat sign":"Symbole manat","ruble sign":"Symbole rouble","yen character":"Sinogramme Yen","yuan character":"Sinogramme Yuan","yuan character, in hong kong and taiwan":"Sinogramme Yuan, Hong Kong et Taiwan","yen/yuan character variant one":"Sinogramme Yen/Yuan, première variante","Loading emoticons...":"Chargement des émoticônes en cours...","Could not load emoticons":"Échec de chargement des émoticônes",People:"Personnes","Animals and Nature":"Animaux & nature","Food and Drink":"Nourriture & boissons",Activity:"Activité","Travel and Places":"Voyages & lieux",Objects:"Objets",Flags:"Drapeaux",Characters:"Caractères","Characters (no spaces)":"Caractères (espaces non compris)","{0} characters":"{0} caractères","Error: Form submit field collision.":"Erreur : conflit de champs lors de la soumission du formulaire.","Error: No form element found.":"Erreur : aucun élément de formulaire trouvé.",Update:"Mettre à jour","Color swatch":"Échantillon de couleurs",Turquoise:"Turquoise",Green:"Vert",Blue:"Bleu",Purple:"Violet","Navy Blue":"Bleu marine","Dark Turquoise":"Turquoise foncé","Dark Green":"Vert foncé","Medium Blue":"Bleu moyen","Medium Purple":"Violet moyen","Midnight Blue":"Bleu de minuit",Yellow:"Jaune",Orange:"Orange",Red:"Rouge","Light Gray":"Gris clair",Gray:"Gris","Dark Yellow":"Jaune foncé","Dark Orange":"Orange foncé","Dark Red":"Rouge foncé","Medium Gray":"Gris moyen","Dark Gray":"Gris foncé","Light Green":"Vert clair","Light Yellow":"Jaune clair","Light Red":"Rouge clair","Light Purple":"Violet clair","Light Blue":"Bleu clair","Dark Purple":"Violet foncé","Dark Blue":"Bleu foncé",Black:"Noir",White:"Blanc","Switch to or from fullscreen mode":"Passer en ou quitter le mode plein écran","Open help dialog":"Ouvrir la boîte de dialogue d'aide",history:"historique",styles:"styles",formatting:"mise en forme",alignment:"alignement",indentation:"retrait","permanent pen":"feutre indélébile",comments:"commentaires","Format Painter":"Reproduire la mise en forme","Insert/edit iframe":"Insérer/modifier iframe",Capitalization:"Mise en majuscules",lowercase:"minuscule",UPPERCASE:"MAJUSCULE","Title Case":"Casse du titre","Permanent Pen Properties":"Propriétés du feutre indélébile","Permanent pen properties...":"Propriétés du feutre indélébile...",Font:"Police",Size:"Taille","More...":"Plus...","Spellcheck Language":"Langue du correcteur orthographique","Select...":"Sélectionner...",Preferences:"Préférences",Yes:"Oui",No:"Non","Keyboard Navigation":"Navigation au clavier",Version:"Version",Anchor:"Ancre","Special character":"Caractères spéciaux","Code sample":"Extrait de code",Color:"Couleur",Emoticons:"Emoticônes","Document properties":"Propriété du document",Image:"Image","Insert link":"Insérer un lien",Target:"Cible",Link:"Lien",Poster:"Publier",Media:"Média",Print:"Imprimer",Prev:"Préc ","Find and replace":"Trouver et remplacer","Whole words":"Mots entiers",Spellcheck:"Vérification orthographique",Caption:"Titre","Insert template":"Ajouter un thème"})},3009:(e,t,r)=>{var n=r(7854),i=r(3111).trim,a=r(1361),o=n.parseInt,s=/^[+-]?0[Xx]/,l=8!==o(a+"08")||22!==o(a+"0x16");e.exports=l?function(e,t){var r=i(String(e));return o(r,t>>>0||(s.test(r)?16:10))}:o},8415:(e,t,r)=>{"use strict";var n=r(9958),i=r(4488);e.exports="".repeat||function(e){var t=String(i(this)),r="",a=n(e);if(a<0||a==1/0)throw RangeError("Wrong number of repetitions");for(;a>0;(a>>>=1)&&(t+=t))1&a&&(r+=t);return r}},863:(e,t,r)=>{var n=r(4326);e.exports=function(e){if("number"!=typeof e&&"Number"!=n(e))throw TypeError("Incorrect invocation");return+e}},6977:(e,t,r)=>{"use strict";var n=r(2109),i=r(9958),a=r(863),o=r(8415),s=r(7293),l=1..toFixed,u=Math.floor,c=function(e,t,r){return 0===t?r:t%2==1?c(e,t-1,r*e):c(e*e,t/2,r)};n({target:"Number",proto:!0,forced:l&&("0.000"!==8e-5.toFixed(3)||"1"!==.9.toFixed(0)||"1.25"!==1.255.toFixed(2)||"1000000000000000128"!==(0xde0b6b3a7640080).toFixed(0))||!s((function(){l.call({})}))},{toFixed:function(e){var t,r,n,s,l=a(this),d=i(e),m=[0,0,0,0,0,0],p="",g="0",f=function(e,t){for(var r=-1,n=t;++r<6;)n+=e*m[r],m[r]=n%1e7,n=u(n/1e7)},h=function(e){for(var t=6,r=0;--t>=0;)r+=m[t],m[t]=u(r/e),r=r%e*1e7},v=function(){for(var e=6,t="";--e>=0;)if(""!==t||0===e||0!==m[e]){var r=String(m[e]);t=""===t?r:t+o.call("0",7-r.length)+r}return t};if(d<0||d>20)throw RangeError("Incorrect fraction digits");if(l!=l)return"NaN";if(l<=-1e21||l>=1e21)return String(l);if(l<0&&(p="-",l=-l),l>1e-21)if(r=(t=function(e){for(var t=0,r=e;r>=4096;)t+=12,r/=4096;for(;r>=2;)t+=1,r/=2;return t}(l*c(2,69,1))-69)<0?l*c(2,-t,1):l/c(2,t,1),r*=4503599627370496,(t=52-t)>0){for(f(0,r),n=d;n>=7;)f(1e7,0),n-=7;for(f(c(10,n,1),0),n=t-1;n>=23;)h(1<<23),n-=23;h(1<<n),f(1,1),h(2),g=v()}else f(0,r),f(1<<-t,0),g=v()+o.call("0",d);return g=d>0?p+((s=g.length)<=d?"0."+o.call("0",d-s)+g:g.slice(0,s-d)+"."+g.slice(s-d)):p+g}})},1058:(e,t,r)=>{var n=r(2109),i=r(3009);n({global:!0,forced:parseInt!=i},{parseInt:i})}},e=>{"use strict";e.O(0,[9755,2109,4093,1870,8771,8135],(()=>{return t=9209,e(e.s=t);var t}));e.O()}]);