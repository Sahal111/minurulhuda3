"""
Document Chunker
================

Splits markdown and other documents into semantically meaningful chunks.
Preserves headings and context where possible.
"""

import re
from typing import List, Dict, Any
from dataclasses import dataclass

@dataclass
class Chunk:
    id: str
    text: str
    metadata: Dict[str, Any]

class DocumentChunker:
    """Smart chunking for markdown documents."""
    
    def __init__(self, max_chars: int = 1500, overlap: int = 200):
        self.max_chars = max_chars
        self.overlap = overlap
        
    def chunk_markdown(self, file_path: str, content: str) -> List[Chunk]:
        """Split markdown by headings, then size."""
        chunks = []
        
        # Simple splitting by H2 (##) as primary semantic boundary
        sections = re.split(r'\n(?=##\s)', content)
        
        chunk_idx = 0
        for section in sections:
            section = section.strip()
            if not section:
                continue
                
            # If section is small enough, keep it as one chunk
            if len(section) <= self.max_chars:
                chunks.append(Chunk(
                    id=f"{file_path}_sec_{chunk_idx}",
                    text=section,
                    metadata={"source": file_path, "type": "markdown"}
                ))
                chunk_idx += 1
            else:
                # Need to split section further, try by paragraph
                paragraphs = section.split('\n\n')
                current_text = ""
                
                for p in paragraphs:
                    if len(current_text) + len(p) < self.max_chars:
                        current_text += p + "\n\n"
                    else:
                        if current_text:
                            chunks.append(Chunk(
                                id=f"{file_path}_sec_{chunk_idx}",
                                text=current_text.strip(),
                                metadata={"source": file_path, "type": "markdown"}
                            ))
                            chunk_idx += 1
                            
                        # Keep overlap if possible
                        overlap_text = current_text[-self.overlap:] if len(current_text) > self.overlap else ""
                        current_text = overlap_text + p + "\n\n"
                
                if current_text:
                    chunks.append(Chunk(
                        id=f"{file_path}_sec_{chunk_idx}",
                        text=current_text.strip(),
                        metadata={"source": file_path, "type": "markdown"}
                    ))
                    chunk_idx += 1
                    
        return chunks
