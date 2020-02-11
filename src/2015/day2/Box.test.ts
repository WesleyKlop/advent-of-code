import Box from './Box'

test('Can create box', () => {
    const box = new Box(0, 0, 0)

    expect(box).toBeInstanceOf(Box)
})

test('Can get box surface area', () => {
    const box1 = new Box(2, 3, 4)
    expect(box1.getSurfaceArea()).toBe(52)

    const box2 = new Box(1, 1, 10)
    expect(box2.getSurfaceArea()).toBe(42)
})

test('Can get wrapping slack', () => {
    const box1 = new Box(2, 3, 4)
    expect(box1.getSlack()).toBe(6)

    const box2 = new Box(1, 1, 10)
    expect(box2.getSlack()).toBe(1)
})

test('Can get required wrapping paper', () => {
    const box1 = new Box(2, 3, 4)
    expect(box1.getRequiredWrapping()).toBe(58)

    const box2 = new Box(1, 1, 10)
    expect(box2.getRequiredWrapping()).toBe(43)
})

test('Can get wrapping ribbon', () => {
    const box1 = new Box(2, 3, 4)
    expect(box1.getWrappingRibbon()).toBe(10)

    const box2 = new Box(1, 1, 10)
    expect(box2.getWrappingRibbon()).toBe(4)
})

test('Can get bow ribbon', () => {
    const box1 = new Box(2, 3, 4)
    expect(box1.getBowRibbon()).toBe(24)

    const box2 = new Box(1, 1, 10)
    expect(box2.getBowRibbon()).toBe(10)
})

export default {}
