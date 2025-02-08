import nextPlugin from "@next/eslint-plugin-next";
import reactPlugin from "eslint-plugin-react";
import hooksPlugin from "eslint-plugin-react-hooks";
import js from "@eslint/js";
import tseslint from "typescript-eslint";
import eslintConfigPrettier from "eslint-config-prettier";

const config = [
  // 適用対象ファイルの設定
  {
    files: ["*.js", "*.jsx", "*.ts", "*.tsx"],
  },
  // 除外対象ファイルの設定
  {
    ignores: [
      "**/prettier.config.js",
      "**/next.config.mjs",
      "**/tsconfig.json",
      "**/next-env.d.ts",
      "**/build/",
      "**/bin/",
      "**/obj/",
      "**/out/",
      "**/.next/",
    ],
  },
  /**
   * ESListの推奨設定を適用
   */
  {
    name: "eslint/recommended",
    rules: js.configs.recommended.rules,
  },
  /**
   * TypeScriptの推奨設定を適用
   */
  ...tseslint.configs.recommended,
  /**
   * Reactの推奨設定を適用
   */
  {
    name: "react/jsx-runtime",
    plugins: {
      react: reactPlugin,
    },
    rules: reactPlugin.configs["jsx-runtime"].rules,
    settings: {
      react: {
        version: "detect",
      },
    },
  },
  /**
   * React Hooksの推奨設定を適用
   */
  {
    name: "react-hooks/recommended",
    plugins: {
      "react-hooks": hooksPlugin,
    },
    rules: hooksPlugin.configs.recommended.rules,
  },
  /**
   * Next.jsの推奨設定を適用
   */
  {
    name: "next/core-web-vitals",
    plugins: {
      "@next/next": nextPlugin,
    },
    rules: {
      ...nextPlugin.configs.recommended.rules,
      ...nextPlugin.configs["core-web-vitals"].rules,
    },
  },
  /**
   * Prettierとの連携
   * Prettierとの設定衝突防止のためにフォーマット関連ルールを無効化
   */
  {
    name: "prettier/config",
    ...eslintConfigPrettier,
  },
  /**
   * プロジェクト固有の設定
   */
  {
    name: "project-custom",
    rules: {
      // 未使用変数の警告を有効化
      "@typescript-eslint/no-unused-vars": "warn",
    },
  },
];

export default config;
