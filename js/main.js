// note that wordBank va-riable is available



function randomize() {

	// REFERENCE:
	
	// alert("hey you should write an actual randomize func...");
	console.log("wordBank: "); console.log(wordBank);

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



	// STARTERS:

	// Position Article
	var positionArticleText = wordBank.positionArticles[0].word;
	document.getElementById('position-article').innerHTML = positionArticleText;
		
	// Position Adjective
	var positionAdjectiveText = wordBank.positionAdjectives[0].word;
	document.getElementById('position-adjective').innerHTML = positionAdjectiveText;
		
	// Position Noun
	var positionNounText = wordBank.positionNouns[0].word;
	document.getElementById('position-noun').innerHTML = positionNounText;
		
	// Position-Domain Preposition
	var positionDomainPrepositionText = wordBank.positionDomainPrepositions[0].word;
	document.getElementById('position-domain-preposition').innerHTML = positionDomainPrepositionText;
		
	// Domain Adjective
	var domainAdjectiveText = wordBank.domainAdjectives[0].word;
	document.getElementById('domain-adjective').innerHTML = domainAdjectiveText;
		
	// Domain Noun
	var domainNounText = wordBank.domainNouns[0].singular + "/" + wordBank.domainNouns[0].plural;
	document.getElementById('domain-noun').innerHTML = domainNounText;
		
	// Domain-Concept Preposition
	var domainConceptPrepositionText = wordBank.domainConceptPrepositions[0].word;
	document.getElementById('domain-concept-preposition').innerHTML = domainConceptPrepositionText;
		
	// Concept Noun
	var conceptNounText = wordBank.conceptNouns[0].word;
	document.getElementById('concept-noun').innerHTML = conceptNounText;



	// dsj todo: first image result from google: http://googlecode.blogspot.in/2012/02/image-results-now-available-from-custom.html
}