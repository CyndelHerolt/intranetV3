(self.webpackChunkintranetv3=self.webpackChunkintranetv3||[]).push([[6450],{6381:(e,t,n)=>{"use strict";n.d(t,{r:()=>a});var a={decimal:"",emptyTable:"Aucune donn&eacute;e disponible dans le tableau",info:"Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",infoEmpty:"Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",infoFiltered:"(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",infoPostFix:"",thousands:",",lengthMenu:"Afficher _MENU_ &eacute;l&eacute;ments",loadingRecords:"Chargement en cours...",processing:"Traitement en cours...",search:"Rechercher&nbsp;:",zeroRecords:"Aucun &eacute;l&eacute;ment &agrave; afficher",paginate:{first:"Premier",last:"Dernier",next:"Suivant",previous:"Pr&eacute;c&eacute;dent"},aria:{sortAscending:": activer pour trier la colonne par ordre croissant",sortDescending:": activer pour trier la colonne par ordre d&eacute;croissant"},searchBuilder:{conditions:{date:{after:"Après le",before:"Avant le",between:"Entre",empty:"Vide",equals:"Egal à",not:"Différent de",notBetween:"Pas entre",notEmpty:"Non vide"},number:{between:"Entre",empty:"Vide",equals:"Egal à",gt:"Supérieur à",gte:"Supérieur ou égal à",lt:"Inférieur à",lte:"Inférieur ou égal à",not:"Différent de",notBetween:"Pas entre",notEmpty:"Non vide"},string:{contains:"Contient",empty:"Vide",endsWith:"Se termine par",equals:"Egal à",not:"Différent de",notEmpty:"Non vide",startsWith:"Commence par"},array:{equals:"Egal à",empty:"Vide",contains:"Contient",not:"Différent de",notEmpty:"Non vide",without:"Sans"}},add:"Ajouter une condition",button:{0:"Recherche avancée",_:"Recherche avancée (%d)"},clearAll:"Effacer tout",condition:"Condition",data:"Donnée",deleteTitle:"Supprimer la règle de filtrage",logicAnd:"Et",logicOr:"Ou",title:{0:"Recherche avancée",_:"Recherche avancée (%d)"},value:"Valeur"}}},4852:(e,t,n)=>{"use strict";var a=n(6381),r=n(9755),i=n(9755);r(document).on("click","#addCategorie",(function(){r.ajax({url:Routing.generate("administration_article_categorie_add"),data:{libelle:r("#libelle").val()},method:"POST",success:function(e){var t=r("#listeCategories").empty();t.append("<thead>\n<tr>\n<th>Libellé</th>\n<th>Nb Article</th>\n<th>Actions</th>\n</tr>\n</thead><tbody>"),i.each(e,(function(e,n){var a="<tr>\n                        <td>"+n.libelle+"</td>\n                        <td>"+n.nbArticles+'</td>\n                        <td><a href="\n                               data-csrf=""\n                               class="btn btn-danger btn-outline btn-square supprimer"\n                               data-provide="tooltip"\n                               data-placement="bottom"\n                               title="Supprimer la catégorie">\n                                <i class="mdi mdi-delete"></i>\n                                <span class="sr-only">Supprimer la catégorie</span>\n                            </a></td>\n                    </tr>';t.append(a)})),t.append("</tbody>"),t.append('<tfoot>\n                <tr>\n                    <td><label for="libelle" class="sr-only">Libelle</label>\n                        <input type="text" placeholder="Libellé de la catégorie" id="libelle" class="form-control"></td>\n                    <td>&nbsp;</td>\n                    <td>\n                        <button class="btn btn-success btn-block" id="addCategorie">Ajouter catégorie</button>\n                    </td>\n                </tr>\n                </tfoot>'),t.dataTable({language:a.r})}})}))}},e=>{"use strict";e.O(0,[9755],(()=>{return t=4852,e(e.s=t);var t}));e.O()}]);