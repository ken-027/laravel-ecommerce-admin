const rewire = require("rewire")
const define_classes = rewire("../define-classes")
const Exporting = define_classes.__get__("Exporting")
// @ponicode
describe("Exporting.models", () => {
    test("0", () => {
        document.body.insertAdjacentHTML("afterbegin", `<div id="wrapper0"><div>
        	<div id="search"></div>
        	<div id="categoryFilter"></div>
        	<div id="brandFilter"></div>
        	<div id="deviceFilter"></div>
        </div>
        </div>`)
        Exporting.models("http://www.example.com/route/123?foo=bar", "string")
        expect(document.getElementById("wrapper0")).to.matchSnapshot()
        document.body.removeChild(document.getElementById("wrapper0"))
    })
})
