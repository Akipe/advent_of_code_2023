import * as fs from 'node:fs';

const inputPathExample = "statement/Day05Part1/input_example.txt"
const returnLineRegex = /\r?\n/

const fileContent = fs.readFileSync(inputPathExample, 'utf-8')

export const getLinesContentFile = (path: string): string[] => {
    const fileContent = fs.readFileSync(path, "utf-8")

    return fileContent.split(returnLineRegex)
}
