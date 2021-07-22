export interface CV {
    originalName: string;
    username: string,
    file: File,
    state: CVState
}

export enum CVState {
    Waiting = 0,
    Reading = 1,
    ContinueProcess = 2,
    Discard = 3,
    Selected = 4
}