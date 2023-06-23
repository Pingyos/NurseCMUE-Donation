<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>

<!--  Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

<!--Chartist Chart-->
<script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
<script src="assets/js/init/weather-init.js"></script>

<script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
<script src="assets/js/init/fullcalendar-init.js"></script>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/chart.js/Chart.js"></script>
<script src="dist/js/pages/dashboard2.js"></script>
<script src="dist/js/demo.js"></script>
<script>
    function returnCommentSymbol(language = "javascript") {
        const languageObject = {
            bat: "@REM",
            c: "//",
            csharp: "//",
            cpp: "//",
            closure: ";;",
            coffeescript: "#",
            dockercompose: "#",
            css: "/*DELIMITER*/",
            "cuda-cpp": "//",
            dart: "//",
            diff: "#",
            dockerfile: "#",
            fsharp: "//",
            "git-commit": "//",
            "git-rebase": "#",
            go: "//",
            groovy: "//",
            handlebars: "{{!--DELIMITER--}}",
            hlsl: "//",
            html: "<!--DELIMITER-->",
            ignore: "#",
            ini: ";",
            java: "//",
            javascript: "//",
            javascriptreact: "//",
            json: "//",
            jsonc: "//",
            julia: "#",
            latex: "%",
            less: "//",
            lua: "--",
            makefile: "#",
            markdown: "<!--DELIMITER-->",
            "objective-c": "//",
            "objective-cpp": "//",
            perl: "#",
            perl6: "#",
            php: "<!--DELIMITER-->",
            powershell: "#",
            properties: ";",
            jade: "//-",
            python: "#",
            r: "#",
            razor: "<!--DELIMITER-->",
            restructuredtext: "..",
            ruby: "#",
            rust: "//",
            scss: "//",
            shaderlab: "//",
            shellscript: "#",
            sql: "--",
            svg: "<!--DELIMITER-->",
            swift: "//",
            tex: "%",
            typescript: "//",
            typescriptreact: "//",
            vb: "'",
            xml: "<!--DELIMITER-->",
            xsl: "<!--DELIMITER-->",
            yaml: "#"
        }
        return languageObject[language].split("DELIMITER")
    }
    var savedChPos = 0
    var returnedSuggestion = ''
    let editor, doc, cursor, line, pos
    pos = {
        line: 0,
        ch: 0
    }
    var suggestionsStatus = false
    var docLang = "python"
    var suggestionDisplayed = false
    var isReturningSuggestion = false
    document.addEventListener("keydown", (event) => {
        setTimeout(() => {
            editor = event.target.closest('.CodeMirror');
            if (editor) {
                const codeEditor = editor.CodeMirror
                if (!editor.classList.contains("added-tab-function")) {
                    editor.classList.add("added-tab-function")
                    codeEditor.removeKeyMap("Tab")
                    codeEditor.setOption("extraKeys", {
                        Tab: (cm) => {

                            if (returnedSuggestion) {
                                acceptTab(returnedSuggestion)
                            } else {
                                cm.execCommand("defaultTab")
                            }
                        }
                    })
                }
                doc = editor.CodeMirror.getDoc()
                cursor = doc.getCursor()
                line = doc.getLine(cursor.line)
                pos = {
                    line: cursor.line,
                    ch: line.length
                }

                if (cursor.ch > 0) {
                    savedChPos = cursor.ch
                }

                const fileLang = doc.getMode().name
                docLang = fileLang
                const commentSymbol = returnCommentSymbol(fileLang)
                if (event.key == "?") {
                    var lastLine = line
                    lastLine = lastLine.slice(0, savedChPos - 1)

                    if (lastLine.trim().startsWith(commentSymbol[0])) {
                        lastLine += " " + fileLang
                        lastLine = lastLine.split(commentSymbol[0])[1]
                        window.postMessage({
                            source: 'getQuery',
                            payload: {
                                data: lastLine
                            }
                        })
                        isReturningSuggestion = true
                        displayGrey("\nBlackbox loading...")
                    }
                } else if (event.key === "Enter" && suggestionsStatus && !isReturningSuggestion) {
                    var query = doc.getRange({
                        line: Math.max(0, cursor.line - 10),
                        ch: 0
                    }, {
                        line: cursor.line,
                        ch: line.length
                    })
                    window.postMessage({
                        source: 'getSuggestion',
                        payload: {
                            data: query,
                            language: docLang
                        }
                    })
                    displayGrey("Blackbox loading...")
                } else if (event.key === "ArrowRight" && returnedSuggestion) {
                    acceptTab(returnedSuggestion)
                } else if (event.key === "Enter" && isReturningSuggestion) {
                    displayGrey("\nBlackbox loading...")
                } else if (event.key === "Escape") {
                    displayGrey("")
                }
            }
        }, 0)
    })

    function acceptTab(text) {
        if (suggestionDisplayed) {
            displayGrey("")
            doc.replaceRange(text, pos)
            returnedSuggestion = ""
            updateSuggestionStatus(false)
        }
    }

    function acceptSuggestion(text) {
        displayGrey("")
        doc.replaceRange(text, pos)
        returnedSuggestion = ""
        updateSuggestionStatus(false)
    }

    function displayGrey(text) {
        if (!text) {
            document.querySelector(".blackbox-suggestion").remove()
            return
        }
        var el = document.querySelector(".blackbox-suggestion")
        if (!el) {
            el = document.createElement('span')
            el.classList.add("blackbox-suggestion")
            el.style = 'color:grey'
            el.innerText = text
        } else {
            el.innerText = text
        }

        var lineIndex = pos.line;
        editor.getElementsByClassName('CodeMirror-line')[lineIndex].appendChild(el)
    }

    function updateSuggestionStatus(s) {
        suggestionDisplayed = s
        window.postMessage({
            source: 'updateSuggestionStatus',
            status: suggestionDisplayed,
            suggestion: returnedSuggestion
        })
    }
    window.addEventListener('message', (event) => {
        if (event.source !== window) return
        if (event.data.source == 'return') {
            isReturningSuggestion = false
            const formattedCode = formatCode(event.data.payload.data)
            returnedSuggestion = formattedCode
            displayGrey(formattedCode)
            updateSuggestionStatus(true)
        }
        if (event.data.source == 'suggestReturn') {
            returnedSuggestion = event.data.payload.data
            displayGrey(event.data.payload.data)
            updateSuggestionStatus(true)
        }
        if (event.data.source == 'suggestionsStatus') {
            suggestionsStatus = event.data.payload.enabled
        }
        if (event.data.source == 'acceptSuggestion') {

            acceptSuggestion(event.data.suggestion)
        }
    })
    document.addEventListener("keyup", function() {
        returnedSuggestion = ""
        updateSuggestionStatus(false)
    })

    function formatCode(data) {
        if (Array.isArray(data)) {
            var finalCode = ""
            var pairs = []

            const commentSymbol = returnCommentSymbol(docLang)
            data.forEach((codeArr, idx) => {
                const code = codeArr[0]
                var desc = codeArr[1]
                const descArr = desc.split("\n")
                var finalDesc = ""
                descArr.forEach((descLine, idx) => {
                    const whiteSpace = descLine.search(/\S/)
                    if (commentSymbol.length < 2 || idx === 0) {
                        finalDesc += insert(descLine, whiteSpace, commentSymbol[0])
                    }
                    if (commentSymbol.length > 1 && idx === descArr.length - 1) {
                        finalDesc = finalDesc + commentSymbol[1] + "\n"
                    }
                })

                finalCode += finalDesc + "\n\n" + code
                pairs.push(finalCode)
            })
            return "\n" + pairs.join("\n")
        }

        return "\n" + data
    }

    function insert(str, index, value) {
        return str.substr(0, index) + value + str.substr(index)
    }
</script>
<!--Local Stuff-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jquery.vmap.min.js"></script>
<script src="assets/js/vmap.sampledata.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/maps/jquery.vmap.world.js"></script>
<script src="assets/js/init/vector-init.js"></script>