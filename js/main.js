// note that wordBank va-riable is available


console.log("\i\n wordBank: "); console.log(wordBank);

new Audio('media/randomize.wav'); // just to get the file to pre-download



function randomize(seed) {

	if (seed){
		Math.seedrandom( seed );
	} else {
		Math.seedrandom( new Date().getTime() );
	}

	// REFERENCE:
	
	// alert("hey you should write an actual randomize func...");

	var randomizationAudio = new Audio('media/randomize.wav');
	randomizationAudio.play();

	// EXAMPLES:
	
	// //random ("float"(decimal)) number between zero and one
	// alert('Math.random() : '+Math.random()); 
	
	// //random integer between zero and 100 (NOTE: 0 and 100 are each half as likely as every other number, because they only get rounded to from a single .5 range, rather than 2 .5 ranges.)
	// alert('Math.round(Math.random()*100) : '+Math.floor(Math.random()*100)); 
	
	// //conditional
	// if (Math.random() > .5 ) { 
	// 	alert('Math.random() was greater than .5')
	// } else { 
	// 	alert('Math.random() was less than .5')
	// }


	// TEXT PROCESSING:
	
	var texts = {};

	var p = 0;

	// Position Article
	p = 1;
	if (Math.random() < p){
		i = Math.floor(Math.random()*wordBank.positionArticles.length);
		texts.positionArticle = wordBank.positionArticles[i].word;
	} else {
		texts.positionArticle = '';
	}
		
	// Position Adjective
	p = .75;
	if (Math.random() < p){
		i = Math.floor(Math.random()*wordBank.positionAdjectives.length);
		texts.positionAdjective = wordBank.positionAdjectives[i].word;
	} else {
		texts.positionAdjective ='';
	}
		
	// Position Noun
	p = 1;
	if (Math.random() < p){
		i = Math.floor(Math.random()*wordBank.positionNouns.length);
		texts.positionNoun = wordBank.positionNouns[i].word;
	} else {
		texts.positionNoun = '';
	}
		
	// Position-Domain Preposition
	p = 1;
	if (Math.random() < p){
		i = Math.floor(Math.random()*wordBank.positionDomainPrepositions.length);
		texts.positionDomainPreposition = wordBank.positionDomainPrepositions[i].word;
	} else {
		texts.positionDomainPreposition = '';
	}
		
	// Domain Adjective
	p = .75;
	if (Math.random() < p){
		i = Math.floor(Math.random()*wordBank.domainAdjectives.length);
		var domainAdjective = wordBank.domainAdjectives[i]
		texts.domainAdjective = domainAdjective.word;
	} else {
		texts.domainAdjective = '';		
	}
		
	// Domain Noun
	p = 1;
	if (Math.random() < p){
		i = Math.floor(Math.random()*wordBank.domainNouns.length);
		if ( ( ! texts.domainAdjective ) || null === domainAdjective.isPlural ){
			var isPlural = Math.random() > .5;
		} else {
			var isPlural = domainAdjective.isPlural;
		}
		if ( isPlural ){
			texts.domainNoun = wordBank.domainNouns[i].plural;		
		} else {
			texts.domainNoun = wordBank.domainNouns[i].singular;		
		}
	} else {
		texts.domainNoun = '';				
	}
			
	// Domain-Concept Preposition
	p = .75;
	if (Math.random() < p){
		i = Math.floor(Math.random()*wordBank.domainConceptPrepositions.length);
		texts.domainConceptPreposition = wordBank.domainConceptPrepositions[i].word;
	} else {
		texts.domainConceptPreposition = '';		
	}
		
	// Concept Noun
	if (texts.domainConceptPreposition){
		i = Math.floor(Math.random()*wordBank.conceptNouns.length);
		texts.conceptNoun = wordBank.conceptNouns[i].word;
	} else {
		texts.conceptNoun = '';		
	}
	

	console.log(texts);


	// TEXT COMPILATION AND USAGE:


	// PER-ELEMENT USAGE:
	var elements = [
		{ id: 'position-article'			, text: texts.positionArticle },
		{ id: 'position-adjective'			, text: texts.positionAdjective },
		{ id: 'position-noun'				, text: texts.positionNoun },
		{ id: 'position-domain-preposition'	, text: texts.positionDomainPreposition },
		{ id: 'domain-adjective'			, text: texts.domainAdjective },
		{ id: 'domain-noun'					, text: texts.domainNoun },
		{ id: 'domain-concept-preposition'	, text: texts.domainConceptPreposition },
		{ id: 'concept-noun'				, text: texts.conceptNoun }
	];
	for (var i = 0; i < elements.length; i++) {
		// sets the text of each browser element
		document.getElementById(elements[i].id).innerHTML = elements[i].text;
	};

	// WHOLE TEXT-GLOB USAGE:
	// var fullTitleText = '';
	// for (var i = 0; i < elements.length; i++) {
	// 	fullTitleText += texts[i].text + ' ';
	// };
	// fullTitleText = fullTitleText.trim();
	// document.getElementById('epic-title').innerHTML = fullTitleText;

	
	// dsj todo: first image result from google (based on fullTitleText): http://googlecode.blogspot.in/2012/02/image-results-now-available-from-custom.html
}





$('#seed').keypress(function (e) { // FAILING
  if (e.which == 13) {
    seededRandom();
    return false;
  }
});


function seededRandom(){
	randomize(
		$('#seed').val().toLowerCase()
	);
}