// note that wordBank va-riable is available


console.log("\r\n wordBank: "); console.log(wordBank);

new Audio('media/randomize.wav'); // just to get the file to pre-download



function randomize() {

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
	
	var texts = [];

	// Position Article
	r = Math.floor(Math.random()*wordBank.positionArticles.length);
	texts.positionArticle = wordBank.positionArticles[r].word;
		
	// Position Adjective
	r = Math.floor(Math.random()*wordBank.positionAdjectives.length);
	texts.positionAdjective = wordBank.positionAdjectives[r].word;
		
	// Position Noun
	r = Math.floor(Math.random()*wordBank.positionNouns.length);
	texts.positionNoun = wordBank.positionNouns[r].word;
		
	// Position-Domain Preposition
	r = Math.floor(Math.random()*wordBank.positionDomainPrepositions.length);
	texts.positionDomainPreposition = wordBank.positionDomainPrepositions[r].word;
		
	// Domain Adjective
	r = Math.floor(Math.random()*wordBank.domainAdjectives.length);
	texts.domainAdjective = wordBank.domainAdjectives[r].word;
		
	// Domain Noun
	r = Math.floor(Math.random()*wordBank.domainNouns.length);
	texts.domainNoun = wordBank.domainNouns[r].singular + "/" + wordBank.domainNouns[r].plural;
		
	// Domain-Concept Preposition
	r = Math.floor(Math.random()*wordBank.domainConceptPrepositions.length);
	texts.domainConceptPreposition = wordBank.domainConceptPrepositions[r].word;
		
	// Concept Noun
	r = Math.floor(Math.random()*wordBank.conceptNouns.length);
	texts.conceptNoun = wordBank.conceptNouns[r].word;
	

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