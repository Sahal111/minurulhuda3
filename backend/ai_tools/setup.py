from setuptools import setup, find_packages

setup(
    name="ai_tools",
    version="1.0.0",
    description="AI Agent Optimization Toolkit for Laravel Projects",
    author="Antigravity Agent",
    packages=find_packages(),
    install_requires=[
        "sentence-transformers>=2.2.0",
        "chromadb>=0.4.0",
        "tiktoken>=0.5.0",
    ],
    python_requires=">=3.10",
)
