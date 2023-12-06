import * as fs from 'node:fs';

const returnLineRegex = /\r?\n/

export const getLinesContentFile = (path: string): string[] => {
    return fs
        .readFileSync(path, "utf-8")
        .split(returnLineRegex)
}
