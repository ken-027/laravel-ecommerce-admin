const rewire = require("rewire")
const orders = rewire("../orders")
const AppOrder = orders.__get__("AppOrder")
// @ponicode
describe("AppOrder.addComment", () => {
    test("0", () => {
        let result = AppOrder.addComment({ preventDefault: () => true })
        expect(result).toMatchSnapshot()
    })

    test("1", () => {
        let result = AppOrder.addComment({ preventDefault: () => false })
        expect(result).toMatchSnapshot()
    })

    test("2", () => {
        let result = AppOrder.addComment(undefined)
        expect(result).toMatchSnapshot()
    })
})
