// note that wordBank va-riable is available


console.log("\i\n wordBank: "); console.log(wordBank);

new Audio('media/randomize.wav'); // just to get the file to pre-download

var fullTitleText = ''; // because we'll want to access this outside the randomize func probs.

function randomize(seed) {

	if (seed){
		Math.seedrandom( seed );
		currentTitleIsNameBased = true;
	} else {
		Math.seedrandom( new Date().getTime() );
		currentTitleIsNameBased = false;
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

	var fullTitleText;
	for (var i = 0; i < elements.length; i++) {
		// sets the text of each browser element
		document.getElementById(elements[i].hyphenCase).innerHTML = texts[elements[i].camelCase];
		if (texts[elements[i].camelCase]){
			fullTitleText += texts[elements[i].camelCase] + ' ';
		}
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


var elements = [
	{ hyphenCase: 'position-article'			, camelCase: 'positionArticle' },
	{ hyphenCase: 'position-adjective'			, camelCase: 'positionAdjective' },
	{ hyphenCase: 'position-noun'				, camelCase: 'positionNoun' },
	{ hyphenCase: 'position-domain-preposition'	, camelCase: 'positionDomainPreposition' },
	{ hyphenCase: 'domain-adjective'			, camelCase: 'domainAdjective' },
	{ hyphenCase: 'domain-noun'					, camelCase: 'domainNoun' },
	{ hyphenCase: 'domain-concept-preposition'	, camelCase: 'domainConceptPreposition' },
	{ hyphenCase: 'concept-noun'				, camelCase: 'conceptNoun' }
];







$(document).ready(function (){
	$('#seed').keypress(function (e) { // FAILING
	  if (e.which == 13) {
	    seededRandom();
	    return false;
	  }
	});
});


function seededRandom(){
	var seed = $('#seed').val().toLowerCase();
	if (seed) {
		randomize(seed)
	} else {
		alert("Please enter your name first.");
	}
}

function urlEncode(str){
	return str.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
	   return '&#'+i.charCodeAt(0)+';';
	});
}

function getFbImageUrlThenCallback(callback){
	var encodedFullTitleText = urlEncode( getFullTitleText() );
	$.ajax('title-image-url.php?epic_title='+encodedFullTitleText).done(function(imageUrl){
		callback(imageurl);
	});
}

function openFbSharer(url) {
	// NOTE: Only the url actually matters, because FB just grabs info based on OG tags of the loaded page; FB understandably doesn't let you specify it to whatever you want via url parameters.
	winWidth = 520;
	winHeight = 350;
    var winTop = (screen.height / 2) - (winHeight / 2);
    var winLeft = (screen.width / 2) - (winWidth / 2);
    var sharerUrl = 'http://www.facebook.com/sharer.php?s=100&p[url]=' + url;
    alert(sharerUrl);
    window.open(
    	sharerUrl, 
    	'sharer', 
    	'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight
    );
}

function getFullTitleText(){
	var fullTitleText = '';
	elements.forEach(function(element){
		// console.log(element.hyphenCase);
		var innerHTML = $('#'+element.hyphenCase).html();
		// console.log(innerHTML);
		if (innerHTML) fullTitleText += innerHTML + ' ';
	});
	return fullTitleText;
}
function getSeedName(){
	if (! currentTitleIsNameBased ) return false;
	return $('#seed').val();
}

function openEpicFbSharer(){
	openFbSharer(
		'http://EpicTitleGenerator.com'
		+ '/?epic_title='+getFullTitleText() 
		+ (  getSeedName()  ?  '&seed_name='+getSeedName()  :  ''  ) 
	);
}