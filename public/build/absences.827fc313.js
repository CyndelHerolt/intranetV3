(self.webpackChunkintranetv3=self.webpackChunkintranetv3||[]).push([[4152],{26381:(e,t,n)=>{"use strict";n.d(t,{r:()=>a});var a={decimal:"",emptyTable:"Aucune donn&eacute;e disponible dans le tableau",info:"Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",infoEmpty:"Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",infoFiltered:"(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",infoPostFix:"",thousands:",",lengthMenu:"Afficher _MENU_ &eacute;l&eacute;ments",loadingRecords:"Chargement en cours...",processing:"Traitement en cours...",search:"Rechercher&nbsp;:",zeroRecords:"Aucun &eacute;l&eacute;ment &agrave; afficher",paginate:{first:"Premier",last:"Dernier",next:"Suivant",previous:"Pr&eacute;c&eacute;dent"},aria:{sortAscending:": activer pour trier la colonne par ordre croissant",sortDescending:": activer pour trier la colonne par ordre d&eacute;croissant"},searchBuilder:{conditions:{date:{after:"Après le",before:"Avant le",between:"Entre",empty:"Vide",equals:"Egal à",not:"Différent de",notBetween:"Pas entre",notEmpty:"Non vide"},number:{between:"Entre",empty:"Vide",equals:"Egal à",gt:"Supérieur à",gte:"Supérieur ou égal à",lt:"Inférieur à",lte:"Inférieur ou égal à",not:"Différent de",notBetween:"Pas entre",notEmpty:"Non vide"},string:{contains:"Contient",empty:"Vide",endsWith:"Se termine par",equals:"Egal à",not:"Différent de",notEmpty:"Non vide",startsWith:"Commence par"},array:{equals:"Egal à",empty:"Vide",contains:"Contient",not:"Différent de",notEmpty:"Non vide",without:"Sans"}},add:"Ajouter une condition",button:{0:"Recherche avancée",_:"Recherche avancée (%d)"},clearAll:"Effacer tout",condition:"Condition",data:"Donnée",deleteTitle:"Supprimer la règle de filtrage",logicAnd:"Et",logicOr:"Ou",title:{0:"Recherche avancée",_:"Recherche avancée (%d)"},value:"Valeur"}}},89097:(e,t,n)=>{"use strict";n(74916),n(23123),n(73210);var a=n(1128),r=n(19755),s=n.n(r),i=n(26381);function o(e,t){s().ajax({type:"GET",url:Routing.generate("application_personnel_absence_get_ajax",{matiere:s()("#absence-matiere").val()}),dataType:"json",success:function(n){var a=e.split("/"),r=a[2].trim()+"-"+a[1].trim()+"-"+a[0].trim();for(var i in 4===t.length&&(t="0"+t),n)if(i==r&&void 0!==n[i][t])for(var o=0;o<n[i][t].length;o++)s()("#etu_"+n[i][t][o]).addClass("absent")}})}s()(document).on("click",".absChangeTypeGroupe",(function(e){e.preventDefault(),e.stopPropagation(),s()(".absChangeTypeGroupe").removeClass("btn-primary"),s()(this).addClass("btn-primary"),s()("#listeEtudiantsAbsences").load(Routing.generate("api_absence_liste_etudiant",{typegroupe:s()(this).data("typegroupe")}),(function(){console.log("then...");var e=s()("#absence-date"),t=s()("#absence-heure");o(e.val(),t.val())}))})),s()(document).on("change","#absence-matiere",(function(){var e=s()(".etudiant"),t=s()("#absence-date"),n=s()("#absence-heure");e.removeClass("absent"),o(t.val(),n.val())})),s()(document).on("change","#absence-date",(function(){var e=s()(".etudiant"),t=s()("#absence-date"),n=s()("#absence-heure");e.removeClass("absent"),o(t.val(),n.val())})),s()(document).on("change","#absence-heure",(function(){var e=s()(".etudiant"),t=s()("#absence-date"),n=s()("#absence-heure");e.removeClass("absent"),o(t.val(),n.val())})),s()(document).on("click",".etudiant",(function(){var e=s()(this).attr("id").split("_");s()(this).hasClass("absent")?(s()(this).removeClass("absent"),s().ajax({type:"POST",url:Routing.generate("application_personnel_absence_saisie_ajax",{matiere:s()("#absence-matiere").val(),etudiant:e[1]}),dataType:"json",data:{date:s()("#absence-date").val(),heure:s()("#absence-heure").val(),action:"suppr"},error:function(){(0,a.qX)("Erreur lors de la tentative de suppression de l'absence !","danger")},success:function(e){e,(0,a.qX)("La suppression a été effectuée avec succés !","success")}})):(s()(this).addClass("absent"),s().ajax({type:"POST",url:Routing.generate("application_personnel_absence_saisie_ajax",{matiere:s()("#absence-matiere").val(),etudiant:e[1]}),dataType:"json",data:{date:s()("#absence-date").val(),heure:s()("#absence-heure").val(),action:"saisie"},error:function(e){"out"===e.responseText?(0,a.qX)("Le délai pour l'enregistrement est dépassé. Contactez le responsable de la departement","danger"):(0,a.qX)("Erreur lors de l'enregistrement.","danger")},success:function(e){(0,a.qX)("Absence enregistrée avec succés !","success")}}))})),s()("#liste-absences").dataTable({language:i.r,fnRowCallback:function(e,t,n,a){"non"===t[5]||"no"===t[5]||"No"===t[5]||"Non"===t[5]?s()("td",e).css("background-color","#fce3e3"):s()("td",e).css("background-color","#e3fcf2")}})},1128:(e,t,n)=>{"use strict";n.d(t,{qX:()=>p,xQ:()=>h,XQ:()=>y,zl:()=>g,FX:()=>C});n(74916),n(23123),n(3843),n(83710),n(73210),n(15306),n(9653);var a,r,s,i=n(19755),o=n.n(i),c=n(86455),u=n.n(c),l=n(19755),d=!1;function p(e,t){switch(t){case"success":window.umbrella.Toast.success(e);break;case"danger":window.umbrella.Toast.error(e);break;case"warning":window.umbrella.Toast.warning(e);break;case"info":window.umbrella.Toast.info(e)}}a=o()(location).attr("pathname"),r=a.split("/"),s=2,"index.php"===r[1]&&r.length>1&&(s=3),"super-administration"===r[s]&&(s+=1),""===r[r.length-1]&&r.pop(),o()(".menu-item").removeClass("active"),o()("#menu-"+r[s]).addClass("active"),u().mixin({customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),o()(document).on("click",".supprimer",(function(e){e.preventDefault();var t=o()(this).attr("href"),n=o()(this).data("csrf");u().fire({title:"Confirmer la suppression ?",text:"L'opération ne pourra pas être annulée.",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Oui, je confirme",cancelButtonText:"Non, Annuler",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}).then((function(e){e.value?o().ajax({url:t,type:"DELETE",data:{_token:n},success:function(e){e.hasOwnProperty("redirect")&&e.hasOwnProperty("url")?document.location.href=e.url:(o()("#ligne_"+e).closest("tr").remove(),p("Suppression effectuée avec succès","success"),u().fire({title:"Supprimé!",text:"L'enregistrement a été supprimé.",icon:"success",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}))},error:function(e,t,n){u().fire({title:"Erreur lors de la suppression!",text:"Merci de renouveler l'opération",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),p("Erreur lors de la tentative de suppression","danger")}}):"cancel"===e.dismiss&&u().fire({title:"Cancelled",text:"OK! Tout est comme avant !",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1})}))})),o()(document).on("click",".confirm-delete",(function(e){e.preventDefault();var t=o()(this).data("href"),n=o()(this).data("uuid"),a=o()(this).data("csrf");console.log(n),console.log(a),u().fire({title:"Confirmer la suppression ?",text:"L'opération ne pourra pas être annulée.",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Oui, je confirme",cancelButtonText:"Non, Annuler",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}).then((function(e){e.value?o().ajax({url:Routing.generate(t,{uuid:n}),type:"DELETE",data:{_token:a},success:function(e){e.hasOwnProperty("redirect")&&e.hasOwnProperty("url")?document.location.href=e.url:(o()("#ligne_"+e).closest("tr").remove(),p("Suppression effectuée avec succès","success"),u().fire({title:"Supprimé!",text:"L'enregistrement a été supprimé.",icon:"success",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}))},error:function(e,t,n){u().fire({title:"Erreur lors de la suppression!",text:"Merci de renouveler l'opération",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1}),p("Erreur lors de la tentative de suppression","danger")}}):"cancel"===e.dismiss&&u().fire({title:"Cancelled",text:"OK! Tout est comme avant !",icon:"error",confirmButtonText:"OK",customClass:{confirmButton:"btn btn-primary",cancelButton:"btn btn-secondary"},buttonsStyling:!1})}))}));var m="",f="text",b=!1;function v(e){var t=o()("#myedit-input-"+e).val();o().ajax({url:m.attr("href"),data:{field:m.data("field"),value:t,type:f},method:"POST",success:function(){m.html(t),o()("#myEdit-zone-"+e).replaceWith(m),b=!1}})}function h(e,t){var n={};return o().each(o()(e).data(),(function(e,a){if("provide"!=(e=e.replace(/-([a-z])/g,(function(e){return e[1].toUpperCase()})))){if(null!=t)switch(t[e]){case"bool":a=Boolean(a);break;case"num":a=Number(a);break;case"array":a=a.split(",")}n[e]=a}})),n}function y(e){e.removeClass("is-valid").addClass("is-invalid")}function g(e){e.removeClass("is-invalid").addClass("is-valid")}function C(e){e.removeClass("is-invalid").removeClass("is-valid")}o()(document).on("click",".myedit",(function(e){e.preventDefault(),m=o()(this);var t,n,a="";b=!0,void 0!==o()(this).data("type")&&(f=o()(this).data("type")),"select"===o()(this).data("type")||("textarea"===o()(this).data("type")?(t=o()(this),n=Date.now(),d=!0,a='<div id="myEdit-zone-'+n+'">\n                      <textarea rows="5" class="form-control" id="myedit-input-'+n+'">'+t.html().trim()+'</textarea>\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide" data-key="'+n+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+n+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'):a=function(e){var t=Date.now();return'<div id="myEdit-zone-'+t+'" class="input-group">\n                      <input type="text" class="form-control" id="myedit-input-'+t+'" value="'+e.html().trim()+'" >\n                      <span class="input-group-append">\n <button class="btn btn-success-outline myedit-valide"  data-key="'+t+'"><i class="fas fa-check"></i></button>\n                        <button class="btn btn-danger-outline myedit-annule"  data-key="'+t+'"><i class="fas fa-times"></i></button>\n                      </span>\n                    </div>'}(o()(this))),o()(this).replaceWith(a),o()("#myedit-input").focus()})),o()(document).on("keyup","#myedit-input",(function(e){13===e.keyCode&&!1===d?v():27===e.keyCode&&o()("#myEdit-zone").replaceWith(m)})),o()(document).on("click",".myedit-valide",(function(e){d=!1,e.preventDefault(),v(o()(this).data("key"))})),o()(document).on("keypress",(function(e){!0===b&&!1===d&&13===e.which&&(e.preventDefault(),v(o()(this).data("key"))),!0===b&&!1===d&&27===e.which&&(e.preventDefault(),o()("#myEdit-zone-"+o()(this).data("key")).replaceWith(m))})),o()(document).on("click",".myedit-annule",(function(e){e.preventDefault(),o()("#myEdit-zone-"+o()(this).data("key")).replaceWith(m)})),l.fn.dataAttr=function(e,t){return o()(this)[0].getAttribute("data-"+e)||t},l.fn.hasDataAttr=function(e){return o()(this)[0].hasAttribute("data-"+e)}}},e=>{"use strict";e.O(0,[9755,2109,6208,9904],(()=>{return t=89097,e(e.s=t);var t}));e.O()}]);