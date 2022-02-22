import { IEventSystem } from "../../../ts-common/events";
import { DataEvents, Diagram, DiagramEvents, IBaseCoords, ItemConfig, SelectionEvents } from "../../../ts-diagram";
import { DiagramEditorEvents, ICoords } from "../types";
import { BlockSelection } from "../BlockSelection";
import { Connect } from "./connect";
import { Id } from "../../../ts-common/types";
export declare function getLength(from: ItemConfig, to: ItemConfig): number;
export declare class Controls {
    connect: Connect;
    private _events;
    private _diagram;
    private _blockSelection;
    private _resize;
    private _diagramSize;
    private _isOrgType;
    constructor(events: IEventSystem<DataEvents | SelectionEvents | DiagramEvents | DiagramEditorEvents>, diagram: Diagram, blockSelection: BlockSelection);
    render(item: ItemConfig, size: any): any;
    setNearShape(shape: ItemConfig): void;
    toggleNearShape(shape: ItemConfig): void;
    getPoint(x: number, y: number): ICoords;
    onMove(event: MouseEvent, mov: ICoords, p: any): void;
    onUp(event?: MouseEvent): void;
    connectOnUp(event: MouseEvent): void;
    protected _moveChilds(id: Id, mov: IBaseCoords): boolean;
    private _rotate;
    private _gripClick;
}
