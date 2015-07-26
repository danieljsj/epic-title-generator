// note that wordBank va-riable is available


console.log("\r\n wordBank: "); console.log(wordBank);

function randomize() {

	// REFERENCE:
	
	// alert("hey you should write an actual randomize func...");

	var randomizationAudio = new Audio('media/randomize.wav');
	randomizationAudio.play();

	// EXAMPLES:
	
	// random ("float"(decimal)) number between zero and one
	// alert('Math.random() : '+Math.random()); 
	
	// random integer between zero and 100 (NOTE: 0 and 100 are each half as likely as every other number, because they only get rounded to from a single .5 range, rather than 2 .5 ranges.)
	// alert('Math.round(Math.random()*100) : '+Math.round(Math.random()*100)); 
	
	// conditional
	// if (Math.random() > .5 ) { 
	// 	alert('Math.random() was greater than .5')
	// } else { 
	// 	alert('Math.random() was less than .5')
	// }



	// TEXT PROCESSING:
	
	var texts = [];

	// Position Article
	texts['positionArticle'] = wordBank.positionArticles[0].word;
		
	// Position Adjective
	texts['positionAdjective'] = wordBank.positionAdjectives[0].word;
		
	// Position Noun
	texts['positionNoun'] = wordBank.positionNouns[0].word;
		
	// Position-Domain Preposition
	texts['positionDomainPreposition'] = wordBank.positionDomainPrepositions[0].word;
		
	// Domain Adjective
	texts['domainAdjective'] = wordBank.domainAdjectives[0].word;
		
	// Domain Noun
	texts['domainNoun'] = wordBank.domainNouns[0].singular + "/" + wordBank.domainNouns[0].plural;
		
	// Domain-Concept Preposition
	texts['domainConceptPreposition'] = wordBank.domainConceptPrepositions[0].word;
		
	// Concept Noun
	texts['conceptNoun'] = wordBank.conceptNouns[0].word;
	


	// TEXT COMPILATION AND USAGE:


	// PER-ELEMENT USAGE:
	var elements = [
		{ id: 'position-article'			, text: texts['positionArticle'] },
		{ id: 'position-adjective'			, text: texts['positionAdjective'] },
		{ id: 'position-noun'				, text: texts['positionNoun'] },
		{ id: 'position-domain-preposition'	, text: texts['positionDomainPreposition'] },
		{ id: 'domain-adjective'			, text: texts['domainAdjective'] },
		{ id: 'domain-noun'					, text: texts['domainNoun'] },
		{ id: 'domain-concept-preposition'	, text: texts['domainConceptPreposition'] },
		{ id: 'concept-noun'				, text: texts['conceptNoun'] }
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