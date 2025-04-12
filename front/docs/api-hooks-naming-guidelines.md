## 関数命名規則ガイドライン（API / Hooks / UI）

本ドキュメントでは、Next.js プロジェクトにおける関数命名の統一ルールについて記載します。特に以下の3層における命名に焦点を当て、責務の明確化と保守性の向上を目的とします。

---

### 🔁 命名対象の3層

| 層                      | 例                  | 主な責務                                            |
| ----------------------- | ------------------- | --------------------------------------------------- |
| UI層（フォームなど）    | `handleAddCategory` | UIイベントのトリガーとなる関数（クリックや送信）    |
| Hooks層（ユースケース） | `addCategory`       | ビジネスロジックの中心。API呼び出しや状態更新を担当 |
| API呼び出し層           | `postCategory`      | 外部／内部APIへの通信を行う責務（HTTP）             |

---

### 🎨 UI層：イベントハンドラ関数

- **プレフィックスに `handle` を使用**
- 主に JSX のイベント属性（例: `onClick`, `onSubmit`）にバインドされる関数
- UI操作の「起点」であり、副作用の発火役

#### ✅ 命名例

```ts
const handleAddCategory = () => { ... }
const handleSubmitForm = () => { ... }
```

---

### ⚙️ Hooks層：ユースケース関数

- **目的ベース（何をしたいか）で命名**
- 状態更新＋API呼び出しなど、複合的な責務を担う
- `useXXX` の中で定義され、UIから呼び出される想定
- UI層やAPI層と **プレフィックスで差別化しない**（文脈で明確に）

#### ✅ 命名例

```ts
const addCategory = async (data: CategoryInput) => { ... }
const updateUserProfile = async () => { ... }
```

#### ❌ NG例

```ts
const handleAddCategory = () => {} // UI層と混同されやすい
const fetchAndUpdateCategories = () => {} // 責務が広すぎる
```

#### 💡 補足：hooks内での `handle` 命名について

- 状態更新などの **UIイベントハンドラを hooks にまとめるケース**では、`handle` プレフィックスを使っても構いません。
- これは UI 層の複雑さを減らす目的で、hooks 側で `onChange`, `onClick` ハンドラなどを定義する設計です。

```ts
// useSignUp.ts の例
const handleSetEmail = (event: React.ChangeEvent<HTMLInputElement>) => {
  setEmail(event.target.value)
}
const handleClickLogin = () => {
  router.push('/login')
}
```

- このような場合も、責務が「UI操作に密接」であることを意識し、`handle` のプレフィックスを維持してください。

---

### 🌐 API層：通信関数

- **HTTPメソッドをプレフィックスに使う（`fetch`, `post`, `put`, `delete` など）**
- Axios や Fetch を使って HTTP 通信を行う関数
- データ取得／送信／更新などに特化

#### ✅ 命名例

```ts
const fetchCategories = async () => { ... }
const postCategory = async (data: CategoryInput) => { ... }
const deleteCategory = async (id: number) => { ... }
```

#### ❌ NG例

```ts
const apiAddCategory = () => {} // プレフィックスが曖昧
const createCategory = () => {} // HTTP動詞との対応が不明確
```

---

### 📌 命名のポイントまとめ

| 層    | プレフィックス例                                            | 命名意図                                 |
| ----- | ----------------------------------------------------------- | ---------------------------------------- |
| UI    | `handle`                                                    | UIイベントのトリガーとして明確にする     |
| Hooks | （なし）目的ベース、または `handle`（UI操作を委譲する場合） | ドメイン操作またはUI操作補助を担う       |
| API   | `fetch` / `post` など                                       | HTTP操作を明示することで責務を明確にする |

---

この命名規則をプロジェクト内で統一することで、可読性・責任の分離・拡張性が向上し、チーム開発の効率化に繋がります。
