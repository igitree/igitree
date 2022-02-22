import { IDataItem } from "../../ts-data";
import { BaseDiagramEditor } from "./BaseDiagramEditor";
import { IMindmapEditorConfig, IOrgEditorConfig } from "./types";
export declare class OrgChartEditor extends BaseDiagramEditor {
    config: IOrgEditorConfig | IMindmapEditorConfig;
    private _menu;
    constructor(container: string | HTMLElement, config: IOrgEditorConfig | IMindmapEditorConfig);
    protected _setHandlers(): void;
    protected _initDiagram(): void;
    protected _initUI(container: any): void;
    protected _initHotkeys(): void;
    protected _getContextMenuData(item: IDataItem): IDataItem[];
    protected _getDefaults(): {
        text: {
            text: string;
        };
    };
}
