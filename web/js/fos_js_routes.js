// Copyright (c) 2020. | David Annebicque | IUT de Troyes  - All Rights Reserved
// @file /Users/davidannebicque/htdocs/intranetV3/web/js/fos_js_routes.js
// @author davidannebicque
// @project intranetV3
// @lastUpdate 23/10/2020 09:57

fos.Router.setData({"base_url":"","routes":{"agenda_qv":{"tokens":[["text","\/agenda\/qv"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"agenda_qv_previ":{"tokens":[["variable","\/","[^\/]++","previ",true],["text","\/agenda\/qv"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"agenda_index":{"tokens":[["variable","\/","[^\/]++","valeur",true],["variable","\/","[^\/]++","filtre",true],["variable","\/","\\d+","semaine",true],["text","\/agenda"],["variable","\/","fr|en","_locale",true]],"defaults":{"semaine":0,"filtre":"prof","valeur":"","_locale":"fr"},"requirements":{"semaine":"\\d+","_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"typedocument_ajax":{"tokens":[["text","\/document\/ajax\/typedocument"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"document_ajax_favori":{"tokens":[["text","\/document\/ajax\/document\/favori"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"document_ajax":{"tokens":[["variable","\/","[^\/]++","typedocument",true],["text","\/document\/ajax\/document"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"document_add_favori":{"tokens":[["variable","\/","[^\/]++","document",true],["text","\/document\/ajax\/add-favori"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"information_categorie":{"tokens":[["variable","\/","[^\/]++","page",true],["variable","\/","[^\/]++","categorie",true],["text","\/information\/categorie"],["variable","\/","fr|en","_locale",true]],"defaults":{"page":1,"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"information_like":{"tokens":[["variable","\/","[^\/]++","slug",true],["text","\/information\/like"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"messagerie_nouveau":{"tokens":[["variable","\/","[^\/]++","message",true],["text","\/messagerie\/ecrire"],["variable","\/","fr|en","_locale",true]],"defaults":{"message":null,"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"messagerie_change_etat":{"tokens":[["text","\/messagerie\/change-etat"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"messagerie_filtre":{"tokens":[["variable","\/","[^\/]++","filtre",true],["text","\/messagerie\/filtre"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"messagerie_liste_messages":{"tokens":[["variable","\/","[^\/]++","page",true],["variable","\/","[^\/]++","filtre",true],["text","\/messagerie\/liste-messages"],["variable","\/","fr|en","_locale",true]],"defaults":{"filtre":"all","page":0,"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"messagerie_sent":{"tokens":[["text","\/messagerie\/envoyer"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"messagerie_draft":{"tokens":[["text","\/messagerie\/sauvegarder"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"messagerie_message_envoye":{"tokens":[["variable","\/","[^\/]++","message",true],["text","\/messagerie\/message-envoye"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"messagerie_message":{"tokens":[["variable","\/","[^\/]++","message",true],["text","\/messagerie"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"notification_marquer_lu":{"tokens":[["text","\/notification\/marquer"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"profil_etudiant_ajax_notes_graph":{"tokens":[["text","\/notes"],["variable","\/","[^\/]++","slug",true],["text","\/etudiant\/profil-ajax"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"quick_view":{"tokens":[["text","\/quick\/view"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"recherche":{"tokens":[["variable","\/","[^\/]++","keyword",true],["text","\/recherche"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"security_password_init":{"tokens":[["variable","\/","[^\/]++","uuid",true],["text","\/connexion\/init-password"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"trombinoscope_etudiant_semestre":{"tokens":[["variable","\/","[^\/]++","semestre",true],["text","\/trombinoscope\/etudiant"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"trombinoscope_etudiant_semestre_type_groupe":{"tokens":[["variable","\/","[^\/]++","typegroupe",true],["variable","\/","[^\/]++","semestre",true],["text","\/trombinoscope\/etudiant"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"trombinoscope_personnel":{"tokens":[["variable","\/","[^\/]++","type",true],["text","\/trombinoscope\/personnel"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"user_add_favori":{"tokens":[["text","\/utilisateur\/ajax\/add-favori"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"user_change_departement_defaut":{"tokens":[["variable","\/","[^\/]++","departement",true],["text","\/utilisateur\/ajax\/change-defaut"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"user_change_semestre":{"tokens":[["variable","\/","[^\/]++","semestre",true],["variable","\/","[^\/]++","etudiant",true],["text","\/utilisateur\/ajax\/change-semestre"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"user_change_departement":{"tokens":[["variable","\/","[^\/]++","departement",true],["variable","\/","[^\/]++","etudiant",true],["text","\/utilisateur\/ajax\/change-departement"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"user_change_annee_sortie":{"tokens":[["variable","\/","[^\/]++","annee",true],["variable","\/","[^\/]++","etudiant",true],["text","\/utilisateur\/ajax\/change-annee-sortie"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"user_profil":{"tokens":[["variable","\/","[^\/]++","onglet",true],["variable","\/","[^\/]++","slug",true],["variable","\/","[^\/]++","type",true],["text","\/utilisateur"],["variable","\/","fr|en","_locale",true]],"defaults":{"onglet":"scolarite","_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_absences_liste_absence_etudiant":{"tokens":[["variable","\/","[^\/]++","etudiant",true],["text","\/administration\/absence\/semestre\/etudiant"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_absences_justifie":{"tokens":[["variable","\/","[^\/]++","etat",true],["variable","\/","[^\/]++","absence",true],["text","\/administration\/absence\/ajax\/justifie"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_absences_ajax_add":{"tokens":[["text","\/administration\/absence\/ajax\/addabs"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_absence_delete":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administration\/absence"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["DELETE"],"schemes":[]},"administration_absence_justificatif_change_etat":{"tokens":[["variable","\/","A|R|D","etat",true],["variable","\/","[^\/]++","uuid",true],["text","\/administration\/absence\/justificatif\/change-etat"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"etat":"A|R|D","_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_alternance_update_tuteur_universitaire":{"tokens":[["variable","\/","[^\/]++","personnel",true],["variable","\/","[^\/]++","alternance",true],["text","\/administration\/alternance\/update\/tuteur-universitaire"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_article_categorie_add":{"tokens":[["text","\/administration\/articles\/gestion\/categorie\/add"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_borne_visibilite":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administration\/bornes\/visibilite"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_configuration_change_option":{"tokens":[["text","\/administration\/configuration\/configuration\/change"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_creneau_bloque_modifie_etat":{"tokens":[["text","\/administration\/creneau\/bloque\/modifie_etat"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_creneau_cours_liste":{"tokens":[["variable","\/","[^\/]++","annee_universitaire",true],["text","\/administration\/creneau\/cours\/liste"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_creneau_cours_new":{"tokens":[["text","\/administration\/creneau\/cours\/new"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_edt_get_event":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administration\/emploi-du-temps\/Actions\/get-event"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_edt_delete":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administration\/emploi-du-temps\/Actions\/delete"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_edt_za_importsemaine":{"tokens":[["text","\/administration\/emploi-du-temps\/zone\/import"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_edt_ajax_update":{"tokens":[["variable","\/","[^\/]++","semaine",true],["variable","\/","[^\/]++","valeur",true],["variable","\/","[^\/]++","filtre",true],["text","\/administration\/emploi-du-temps\/ajax-update"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_edt_service_realise_affiche":{"tokens":[["variable","\/","[^\/]++","personnel",true],["variable","\/","[^\/]++","matiere",true],["variable","\/","[^\/]++","semestre",true],["text","\/administration\/emploi-du-temps\/realise\/service-realise"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST","GET"],"schemes":[]},"administration_edt_realise_ajax_modules":{"tokens":[["text","\/administration\/emploi-du-temps\/realise\/ajax\/enseignant\/modules"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"adm_etudiant_change_etat":{"tokens":[["variable","\/","[^\/]++","etat",true],["variable","\/","[^\/]++","uuid",true],["text","\/administration\/etudiant\/change-etat"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"adm_etudiant_edit_ajax":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administration\/etudiant\/edit-ajax"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_etudiant_groupe_affecte":{"tokens":[["variable","\/","[^\/]++","typeGroupe",true],["text","\/administration\/etudiant\/groupe\/affecte"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_etudiant_groupe_change":{"tokens":[["text","\/administration\/etudiant\/groupe\/change"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_evaluation_modifiable":{"tokens":[["variable","\/","[^\/]++","uuid",true],["text","\/administration\/evaluation\/modifiable"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_evaluation_visibilite":{"tokens":[["variable","\/","[^\/]++","uuid",true],["text","\/administration\/evaluation\/visibilite"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_groupe_ajax_edit":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administration\/groupe\/ajax\/update"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_groupe_change_parent":{"tokens":[["text","\/administration\/groupe\/ajax\/update-parent"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_groupe_change_typegroupe":{"tokens":[["text","\/administration\/groupe\/ajax\/update-typegroupe"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_groupe_change_parcours":{"tokens":[["text","\/administration\/groupe\/ajax\/update-parcours"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_groupe_liste_semestre":{"tokens":[["variable","\/","[^\/]++","semestre",true],["text","\/administration\/groupe\/liste"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_groupe_export":{"tokens":[["variable",".","csv|xlsx|pdf","_format",true],["text","\/export"],["variable","\/","[^\/]++","semestre",true],["text","\/administration\/groupe"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_format":"csv|xlsx|pdf","_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_groupe_new":{"tokens":[["variable","\/","[^\/]++","semestre",true],["text","\/administration\/groupe\/new"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET","POST"],"schemes":[]},"administration_groupe_duplicate":{"tokens":[["variable","\/","[^\/]++","groupe",true],["text","\/administration\/groupe\/duplicate"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_hrs_index":{"tokens":[["variable","\/","\\d+","annee",true],["text","\/administration\/service-previsionnel\/hrs"],["variable","\/","fr|en","_locale",true]],"defaults":{"annee":0,"_locale":"fr"},"requirements":{"annee":"\\d+","_locale":"fr|en"},"hosttokens":[],"methods":["GET","POST"],"schemes":[]},"administration_matiere_diplome":{"tokens":[["variable","\/","[^\/]++","diplome",true],["text","\/administration\/matiere\/diplome"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_matiere_export":{"tokens":[["variable",".","csv|xlsx|pdf","_format",true],["text","\/export"],["variable","\/","[^\/]++","diplome",true],["text","\/administration\/matiere"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_format":"csv|xlsx|pdf","_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_personnel_load_liste":{"tokens":[["variable","\/","permanent|vacataire","type",true],["text","\/administration\/personnel\/ajax\/load-liste"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"type":"permanent|vacataire","_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_personnel_export":{"tokens":[["variable",".","csv|xlsx|pdf","_format",true],["variable","_","[^\/\\.]++","type",true],["text","\/administration\/personnel\/export"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_format":"csv|xlsx|pdf","_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_personnel_create":{"tokens":[["text","\/administration\/personnel\/create"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET","POST"],"schemes":[]},"administration_personnel_show":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administration\/personnel"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_personnel_edit":{"tokens":[["text","\/edit"],["variable","\/","[^\/]++","id",true],["text","\/administration\/personnel"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET","POST"],"schemes":[]},"administration_personnel_delete":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administration\/personnel"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["DELETE"],"schemes":[]},"admin_personnel_departement_modifier_droit":{"tokens":[["variable","\/","[^\/]++","personnel",true],["text","\/administration\/personnel\/modifier-droit"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_previsionnel_index":{"tokens":[["variable","\/","[^\/]++","annee",true],["text","\/administration\/service-previsionnel\/annee"],["variable","\/","fr|en","_locale",true]],"defaults":{"annee":0,"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_previsionnel_matiere":{"tokens":[["variable","\/","[^\/]++","annee",true],["variable","\/","[^\/]++","matiere",true],["text","\/administration\/service-previsionnel\/matiere"],["variable","\/","fr|en","_locale",true]],"defaults":{"annee":0,"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_previsionnel_semestre":{"tokens":[["variable","\/","[^\/]++","annee",true],["variable","\/","[^\/]++","semestre",true],["text","\/administration\/service-previsionnel\/semestre"],["variable","\/","fr|en","_locale",true]],"defaults":{"annee":0,"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_previsionnel_personnel":{"tokens":[["variable","\/","[^\/]++","annee",true],["variable","\/","[^\/]++","personnel",true],["text","\/administration\/service-previsionnel\/personnel"],["variable","\/","fr|en","_locale",true]],"defaults":{"annee":0,"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_previsionnel_ajax_edit":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administration\/service-previsionnel\/ajax\/edit"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_rattrapage_change_etat":{"tokens":[["variable","\/","A|R","etat",true],["variable","\/","[^\/]++","uuid",true],["text","\/administration\/rattrapage\/change-etat"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"etat":"A|R","_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_rattrapage_planning_change":{"tokens":[["variable","\/","date|heure|salle","type",true],["variable","\/","[^\/]++","uuid",true],["text","\/administration\/rattrapage\/planning\/change"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"type":"date|heure|salle","_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_rattrapage_update_global":{"tokens":[["variable","\/","[^\/]++","diplome",true],["variable","\/","salle|heure|date","type",true],["text","\/administration\/rattrapage\/planning\/update_global"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"type":"salle|heure|date","_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_reservation_materiel_commun_add":{"tokens":[["text","\/administration\/materiel-commun\/reservation\/ajax\/add"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_reservation_materiel_commun_suppr":{"tokens":[["text","\/administration\/materiel-commun\/reservation\/ajax\/suppr"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["DELETE"],"schemes":[]},"administration_scolarite_ues_semestre":{"tokens":[["variable","\/","[^\/]++","semestre",true],["text","\/administration\/scolarite\/ajax\/ues"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_type_groupe_liste_semestre":{"tokens":[["variable","\/","[^\/]++","semestre",true],["text","\/administration\/type-de-groupe\/liste"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_type_groupe_new":{"tokens":[["variable","\/","[^\/]++","semestre",true],["text","\/administration\/type-de-groupe\/new"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_type_groupe_ajax_edit":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administration\/type-de-groupe\/ajax\/update"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_typegroupe_change_type":{"tokens":[["variable","\/","[^\/]++","typeGroupe",true],["text","\/administration\/type-de-groupe\/ajax\/update-type"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_type_groupe_defaut":{"tokens":[["variable","\/","[^\/]++","semestre",true],["variable","\/","[^\/]++","typegroupe",true],["text","\/administration\/type-de-groupe\/update-defaut"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"administration_type_groupe_duplicate":{"tokens":[["variable","\/","[^\/]++","typegroupe",true],["text","\/administration\/type-de-groupe\/duplicate"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"administration_stage_etudiant_ajax_edit":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administration\/stage\/etudiant\/ajax\/edit"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_stage_etudiant_change_tuteur":{"tokens":[["variable","\/","[^\/]++","tuteur",true],["variable","\/","[^\/]++","stageEtudiant",true],["text","\/administration\/stage\/etudiant\/change-tuteur"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_stage_periode_courrier_sauvegarde_modele":{"tokens":[["variable","\/","[^\/]++","mail",true],["variable","\/","[^\/]++","uuid",true],["text","\/administration\/stage\/periode\/courrier\/sauvegarde-modele"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"administration_stage_periode_courrier_reset":{"tokens":[["variable","\/","[^\/]++","etat",true],["variable","\/","[^\/]++","id",true],["text","\/administration\/stage\/periode\/courrier\/reset"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"adresse_ajax_edit":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/ajax\/adresse\/edit"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"contact_ajax_edit":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/ajax\/contact\/edit"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"entreprise_ajax_edit":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/ajax\/entreprise\/edit"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"etudiant_ajax_edit_uuid":{"tokens":[["variable","\/","[^\/]++","uuid",true],["text","\/ajax\/etudiant\/edit\/uuid"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"etudiant_ajax_edit":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/ajax\/etudiant\/edit"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_absence_liste_etudiant":{"tokens":[["variable","\/","\\d+","typegroupe",true],["text","\/api\/absence\/liste\/etudiant"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"typegroupe":"\\d+","_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_etudiants_semestre":{"tokens":[["variable","\/","[^\/]++","semestre",true],["text","\/api\/etudiant\/semestre"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_etudiant_departement":{"tokens":[["text","\/api\/etudiant\/departement"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_type_groupe_semestre":{"tokens":[["variable","\/","[^\/]++","semestre",true],["text","\/api\/groupe\/type-groupe"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_groupe_type_groupe":{"tokens":[["variable","\/","[^\/]++","typeGroupe",true],["text","\/api\/groupe\/groupe"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_matieres_semestre":{"tokens":[["variable","\/","[^\/]++","semestre",true],["text","\/api\/matiere\/semestre"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_matiere":{"tokens":[["variable","\/","[^\/]++","matiere",true],["text","\/api\/matiere"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_export_document_matiere":{"tokens":[["variable","\/","[^\/]++","matiere",true],["text","\/api\/matiere\/document\/export"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_liste_ue_by_semestre":{"tokens":[["text","\/api\/matiere\/ues\/listbysemestre"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_liste_parcour_by_semestre":{"tokens":[["text","\/api\/matiere\/parcours\/listbysemestre"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_matieres_semestre_personnel":{"tokens":[["variable","\/","[^\/]++","personnel",true],["variable","\/","[^\/]++","semestre",true],["text","\/api\/matiere\/matiere\/semestre\/personnel"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_enseignants_type":{"tokens":[["variable","\/","[^\/]++","type",true],["text","\/api\/personnel\/enseignants"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_enseignants_departement":{"tokens":[["text","\/api\/personnel\/enseignants"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_personnel_recherche":{"tokens":[["variable","\/","[^\/]++","needle",true],["text","\/api\/personnel\/personnel\/recherche"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_personnel_add_to_departement":{"tokens":[["variable","\/","[^\/]++","departement",true],["variable","\/","[^\/]++","slug",true],["text","\/api\/personnel\/personnel\/departement\/add"],["variable","\/","fr|en","_locale",true]],"defaults":{"departement":null,"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_all_personnel":{"tokens":[["text","\/api\/personnel\/all"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"api_previsionnel_matiere":{"tokens":[["variable","\/","[^\/]++","matiere",true],["text","\/api\/previsionnel\/matiere"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"app_etudiant_absence_detail":{"tokens":[["variable","\/","[^\/]++","uuid",true],["text","\/application\/etudiant\/absence\/details"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"app_etudiant_qualite_ajax_reponse":{"tokens":[["variable","\/","[^\/]++","questionnaire",true],["text","\/application\/etudiant\/qualite\/ajax\/reponse"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"app_etudiant_qualite_ajax_reponse_txt":{"tokens":[["variable","\/","[^\/]++","questionnaire",true],["text","\/application\/etudiant\/qualite\/ajax\/reponse-txt"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"application_personnel_disponibilite_update":{"tokens":[["text","\/application\/personnel\/disponibilite\/update"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"application_personnel_note_ajax_saisie":{"tokens":[["variable","\/","[^\/]++","uuid",true],["text","\/application\/personnel\/note\/sauvegarde"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST","GET"],"schemes":[]},"application_personnel_progression_update":{"tokens":[["variable","\/","[^\/]++","matiere",true],["text","\/application\/personnel\/progression\/update"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"application_personnel_absence_get_ajax":{"tokens":[["variable","\/","[^\/]++","matiere",true],["text","\/application\/personnel\/absence\/ajax\/absences"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET"],"schemes":[]},"application_personnel_absence_saisie_ajax":{"tokens":[["variable","\/","[^\/]++","etudiant",true],["variable","\/","[^\/]++","matiere",true],["text","\/application\/personnel\/absence\/ajax\/saisie"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"sa_annee_universitaire_change_active":{"tokens":[["variable","\/","[^\/]++","annee",true],["text","\/administratif\/annee-universitaire\/annee-active\/change"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"sa_diplome_edit_ajax":{"tokens":[["text","\/edit-ajax"],["variable","\/","[^\/]++","id",true],["text","\/administratif\/structure\/diplome"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["POST"],"schemes":[]},"sa_etudiant_recherche":{"tokens":[["variable","\/","[^\/]++","needle",true],["text","\/administratif\/etudiants\/recherche"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"sa_personnel_departement_modifier_droit":{"tokens":[["variable","\/","[^\/]++","pf",true],["text","\/administratif\/departement\/personnel\/modifier-droit"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"sa_previsionnel_personnel":{"tokens":[["variable","\/","[^\/]++","annee",true],["variable","\/","[^\/]++","personnel",true],["text","\/administratif\/previsionnel"],["variable","\/","fr|en","_locale",true]],"defaults":{"annee":0,"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"sa_rh_personnel_show":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administratif\/ressources-humaines\/show"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"sa_rh_ldap_search":{"tokens":[["text","\/administratif\/ressources-humaines\/search-ldap"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":[],"schemes":[]},"sa_rh_personnel_edit":{"tokens":[["text","\/edit"],["variable","\/","[^\/]++","id",true],["text","\/administratif\/ressources-humaines"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["GET","POST"],"schemes":[]},"sa_rh_delete_personnel":{"tokens":[["variable","\/","[^\/]++","id",true],["text","\/administratif\/ressources-humaines"],["variable","\/","fr|en","_locale",true]],"defaults":{"_locale":"fr"},"requirements":{"_locale":"fr|en"},"hosttokens":[],"methods":["DELETE"],"schemes":[]}},"prefix":"","host":"localhost","port":"","scheme":"http","locale":[]});
