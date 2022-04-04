function HideList() {
    $( "#List" ).removeClass( "display-block" ).addClass( "display-none" );
    $( "#hideList" ).removeClass( "display-none" ).addClass( "display-block" );
    $( "#wordList" ).addClass( "display-none" );
    $( "#deleteList" ).removeClass( "display-none" );
}

function ShowList() {
    $( "#hideList" ).removeClass( "display-block" ).addClass( "display-none" );
    $( "#List" ).removeClass( "display-none" ).addClass( "display-block" );
    $( "#deleteList" ).addClass( "display-none" );
    $( "#wordList" ).removeClass( "display-none" );
}

function ChangeTransNLEN() {
    $( "#NLEN" ).removeClass( "trans-inactive" ).addClass( "trans-active display-none" );
    $( "#ENNL" ).removeClass( "trans-active display-none" ).addClass( "trans-inactive" );
    $( "#nl-en" ).removeClass( "display-none" );
    $( "#en-nl" ).addClass( "display-none" );
    $( "#score2" ).addClass( "display-none" );
    $( "#score" ).removeClass( "display-none" );

}

function ChangeTransENNL() {
    $( "#ENNL" ).removeClass( "trans-inactive" ).addClass( "trans-active display-none" );
    $( "#NLEN" ).removeClass( "trans-active display-none" ).addClass( "trans-inactive" );
    $( "#en-nl" ).removeClass( "display-none" );
    $( "#nl-en" ).addClass( "display-none" );
    $( "#score" ).addClass( "display-none" );
    $( "#score2" ).removeClass( "display-none" );

}

function ChangeTransNLENPrac() {
    $( "#NLEN" ).removeClass( "trans-inactive" ).addClass( "trans-active display-none" );
    $( "#ENNL" ).removeClass( "trans-active display-none" ).addClass( "trans-inactive" );
    $( "#nl-en" ).removeClass( "display-none" );
    $( "#en-nl" ).addClass( "display-none" );
    $( "#next-question" ).removeClass( "display-none" );
    $( "#next-question2" ).addClass( "display-none" );
}

function ChangeTransENNLPrac() {
    $( "#ENNL" ).removeClass( "trans-inactive" ).addClass( "trans-active display-none" );
    $( "#NLEN" ).removeClass( "trans-active display-none" ).addClass( "trans-inactive" );
    $( "#en-nl" ).removeClass( "display-none" );
    $( "#nl-en" ).addClass( "display-none" );
    $( "#next-question" ).addClass( "display-none" );
    $( "#next-question2" ).removeClass( "display-none" );
}

function delete_data(d){
    let id = d;
    console.log(id)
    $.ajax({
    type: "post",
    url: "delete-data.php",
    data: {id:id},
    success: function(){
        $('#deleteWordForm'+id).fadeOut('fast');
        $('#deleteWordForm2'+id).fadeOut('fast');
    }
    });
}

function ResetForm() {
    for (let x = 0; x < 10; x++) {
        $( "#wordCheck"+x ).removeClass( "right-ans" );
    }
    score = 0;
    $( "#score" ).hide();
}

function ResetForm2() {
    for (let y = 0; y < 10; y++) {
        $( "#wordCheck1"+y ).removeClass( "right-ans" );
    }
    score2 = 0;
    $( "#score2" ).hide();
}

window.addEventListener("load", function () {
    let id = window.location.toString().split("id=")[1];

    async function getWordsEN() {
        return (r = await fetch("http://e-learning.nl/get-list.php?id=" + id)
            .then((response) => response.json())
            .then(function (data) {   
                return data;
            })
            .catch((error) => {
                console.log(error);
                document.getElementById("container").classList.add("display-none");
                document.getElementById("no-word-err").classList.remove("display-none");

            }));
    }

    async function getWordsNL() {
        return (r = await fetch("http://e-learning.nl/get-list.php?id=" + id)
            .then((response) => response.json())
            .then(function (data) {
                return data;
            })
            .catch((error) => {
                console.log(error);
            }));
    }

    function showScore() {
        document.getElementById("nlword-nl").style.display = "none";
        document.getElementById("nlword-en").style.display = "none";
        document.getElementById("next-question").style.display = "none";
        document.getElementById("score").innerHTML = "Je hebt " + score + "/" + totalWords + " woorden goed!";
    }

    function showScore2() {
        document.getElementById("enword-nl").style.display = "none";
        document.getElementById("enword-en").style.display = "none";
        document.getElementById("next-question2").style.display = "none";
        document.getElementById("score2").innerHTML = "Je hebt " + score2 + "/" + totalWords2 + " woorden goed!";
    }
    
    getWordsEN().then(function (d) {

        function randomWordNL() {
            range = Math.floor(Math.random() * d.length);
            randomItem = d[range];
            d.splice(range, 1);
            document.getElementById("nlword-nl").innerHTML = randomItem.word_nl;
        }

        totalWords = Object.keys(d).length;
        answeredQuestions = 0;
        score = 0;

        randomWordNL();

        document.getElementById("next-question").addEventListener("click", function () {
            let woordinput = document.getElementById("nlword-en").value;
            if (woordinput === randomItem.word_en) {
                document.getElementById("nlword-en").value = "";
                ++score;
                ++answeredQuestions;
                if (totalWords == answeredQuestions) {
                    showScore();
                } else {
                    randomWordNL();
                }
            } else {
                document.getElementById("nlword-en").value = "";
                ++answeredQuestions;
                if (totalWords == answeredQuestions) {
                    showScore();
                } else {
                    randomWordNL();
                }
            }
        });

        
    });

    getWordsNL().then(function (d) {
        function randomWordEN() {
            range = Math.floor(Math.random() * d.length);
            randomItem2 = d[range];
            d.splice(range, 1);
            document.getElementById("enword-en").innerHTML = randomItem2.word_en;
        }

        totalWords2 = Object.keys(d).length;
        answeredQuestions2 = 0;
        score2 = 0;

        randomWordEN();

        document.getElementById("next-question2").addEventListener("click", function () {
            let woordinput = document.getElementById("enword-nl").value;
            if (woordinput === randomItem2.word_nl) {
                document.getElementById("enword-nl").value = "";
                ++score2;
                ++answeredQuestions2;
                if (totalWords2 == answeredQuestions2) {
                    showScore2();
                } else {
                    randomWordEN();
                }
            } else {
                document.getElementById("enword-nl").value = "";
                ++answeredQuestions2;
                if (totalWords2 == answeredQuestions2) {
                    showScore2();
                } else {
                    randomWordEN();
                }
            }
        });
    });
});

