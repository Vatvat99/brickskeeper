$( document ).ready(function() {

	var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

	/* SWITCH MINIFIGURES/SETS
	------------------------------------------------------ */

	// Au clic sur un des boutons du switch
	$('.item-type-button').on('click', function() {
		// On active ce bouton
		$('.item-type-button').removeClass('active');
		$( this ).addClass('active');
		// On récupère le type d'item correspondant à ce bouton
		var itemType = $( this ).data('type');
		// On passe la valeur au champ caché
		$('.item-type-field').val(itemType);
	});
	
	/* GESTION DES LISTES DES GAMMES ET DES SERIES 
	------------------------------------------------------ */

	// Déplacement des listes dans le DOM
	if(windowWidth < 732) {
		// Version mobile
		$('.ranges-list').each(function () {
			$(this).appendTo('body');
		});
		$('.series-list').each(function () {
			$(this).appendTo('body');
		});
	} 
	else {
		// Version desktop
		$('.ranges-list').each(function () {
			$(this).appendTo('.search-container');
		});
		$('.series-list').each(function () {
			$(this).appendTo('.search-container');
		});
	}

	// Au clic dans le champ "Gamme" : Ouverture de la liste des gammes
	$('input#search_range').focusin(function() {

		var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

		// On vide le champ si c'est la valeur par défaut
		if($(this).val() == 'Gamme') {
			$(this).val('');
		}

		// On récupère le type d'item que l'on recherche
		var itemType = $('.item-type-field').val();

		// On déplie la liste des gammes
		$('.series-list').addClass('to-left');
		$('.search').addClass('to-left');
		$('.ranges-list').addClass('to-left');
		$('.ranges-list[data-item-type="' + itemType + '"]').removeClass('to-left');
		$('.ranges-list[data-item-type="' + itemType + '"]').addClass('shown');
		// Si on est en affichage mobile
		if(windowWidth < 732) 
		{
			//Apparition du fond
			$('.search-list-overlay').css({'filter' : 'alpha(opacity=50)'}).fadeIn(100);
		}
	});

	// Au clic hors du champ "Gamme" : Fermeture de la liste des gammes
	$('input#search_range').focusout(function() {

		// On replie la liste des gammes
		$('.series-list').removeClass('to-left');
		$('.search').removeClass('to-left');
		$('.ranges-list').removeClass('to-left');
		$('.ranges-list').removeClass('shown');
		//Disparition du fond
		$('.search-list-overlay').fadeOut(100);

		// On remet la valeur par défaut si le champ est vide
		if($(this).val() == '') {
			$(this).val('Gamme');
			$('input#search_selected-range-alias').val('none');
		}

	});

	// Au clic dans le champ "Série" : Ouverture de la liste des séries
	$('input#search_serie').focusin(function() {

		var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

		// On récupère le type d'item que l'on recherche
		var itemType = $('.item-type-field').val();

		// On vide le champ si c'est la valeur par défaut
		if($(this).val() == 'Série') {
			$(this).val('');
		}
		
		// On déplie la liste des séries
		$('.ranges-list').addClass('to-left');
		$('.series-list').addClass('to-left');
		$('.search').addClass('to-left');
		$('.series-list[data-range="' + ($('input#search_selected_range_alias').val()) + '"][data-item-type="' + itemType + '"]').removeClass('to-left');
		$('.series-list[data-range="' + ($('input#search_selected_range_alias').val()) + '"][data-item-type="' + itemType + '"]').addClass('shown');
		// Si on est en affichage mobile
		if(windowWidth < 732) 
		{
			//Apparition du fond
			$('.search-list-overlay').css({'filter' : 'alpha(opacity=50)'}).fadeIn(100);
		}
	});
	// Au clic hors du champ "Série" : Fermeture de la liste des séries
	$('input#search_serie').focusout(function() {
		// On replie la liste des séries
		$('.ranges-list').removeClass('to-left');
		$('.series-list').removeClass('to-left');
		$('.search').removeClass('to-left');
		$('.series-list').removeClass('shown');
		//Disparition du fond
		$('.search-list-overlay').fadeOut(100);

		// On remet la valeur par défaut si le champ est vide
		if($(this).val() == '') {
			$(this).val('Série');
			$('input#search_selected_serie_alias').val('none');
			// Si le champs gamme est vide lui aussi
			if($('input#search_range').val() == 'Gamme') {
				// On remet la valeur par défaut dans le champ caché
				$('input#search_selected_range_alias').val('none');
			}
		}
	});

	// Au clic sur une gamme, on remplit le champ texte correspondant
	$('.ranges-list li').mousedown(function() {
		$('input#search_range').val($(this).text().trim());
		$('.range.erase').removeClass('hidden');
		$('.range.erase').addClass('shown');
		$('input#search_selected_range_alias').val($(this).data('alias'));
		// On remet la valeur par défaut dans le champ série
		$('input#search_serie').val('Série');
		$('.serie.erase').removeClass('shown');
		$('.serie.erase').addClass('hidden');
		// Si il n'existe pas de liste de série correspondant à la gamme sélectionnée, on désactive le champ séries
		if($('.series-list[data-range="' + $(this).data('alias') + '"]').get(0) == null)
		{
			$('input#search_serie').attr('disabled', 'disabled');
			$('input#search_serie').addClass('disabled');
		}
		else 
		{
			$('input#search_serie').removeAttr('disabled');
			$('input#search_serie').removeClass('disabled');
		}

	});
	// Au clic sur une série, on remplit le champ texte correspondant
	$('.series-list li').mousedown(function() {
		$('input#search_serie').val($(this).text().trim());
		$('.serie.erase').removeClass('hidden');
		$('.serie.erase').addClass('shown');
		$('input#search_selected_serie_alias').val($(this).data('alias'));
	});

	// Au clic sur la croix gammes, on efface le contenu des champs "Gamme" et "Série"
	$('.range.erase').mousedown(function() {
		$('input#search_range').val('Gamme');
		$('input#search_selected_range_alias').val('none');
		$('input#search_serie').val('Série');
		$('input#search_selected_serie_alias').val('none');
		// On cache les croix
		$('.range.erase').removeClass('shown');
		$('.range.erase').addClass('hidden');
		$('.serie.erase').removeClass('shown');
		$('.serie.erase').addClass('hidden');
		// On réactive le champ "Série"
		$('input#search_serie').removeAttr('disabled');
		$('input#search_serie').removeClass('disabled');
	});

	// Au clic sur la croix séries, on efface le contenu du champ
	$('.serie.erase').mousedown(function() {
		$('input#search_serie').val('Série');
		$('input#search_selected_serie_alias').val('none');
		// On cache la croix
		$('.serie.erase').removeClass('shown');
		$('.serie.erase').addClass('hidden');
	});

	// Scrollbars jquery
	$('.ranges-list, .series-list').mCustomScrollbar({
		scrollInertia: 1000,
		scrollButtons:{
		  enable:true
		}
	});

});

// Quand on redimensionne la fenêtre
$(window).resize(function() {

	var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

	/* GESTION DES LISTES DES GAMMES ET DES SERIES 
	------------------------------------------------------ */

	// Déplacement des listes dans le DOM
	if(windowWidth < 732) {
		// Version mobile
		$('.ranges-list').each(function () {
			$(this).appendTo('body');
		});
		$('.series-list').each(function () {
			$(this).appendTo('body');
		});
	} 
	else {
		// Version desktop
		$('.ranges-list').each(function () {
			$(this).appendTo('.search-container');
		});
		$('.series-list').each(function () {
			$(this).appendTo('.search-container');
		});
	}

});